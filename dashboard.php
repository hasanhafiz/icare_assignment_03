<?php 
require_once 'core/init.php';

if ( Session::exists( 'user' ) ){
    $user = new User();    
    $user->get( Session::get('user') ); // get user email
    $feedback = new Feedback();
    $feedback_data = $feedback->load();
} else {
    Redirect::to('index.php');
}

$feedback_link = $_SERVER['REQUEST_SCHEME'] . '://' .  $_SERVER['HTTP_HOST'] . '/feedback.php?user_id=' . $user->data()->user_id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Feedback App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<?php include_once 'includes/navbar.php'; ?>
<main class="">
    <div class="relative flex min-h-screen overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        
        <div class="relative max-w-7xl mx-auto">
            <div class="flex justify-end">
                <span class="block text-gray-600 font-mono border border-gray-400 rounded-xl px-2 py-1"><a href="<?php echo $feedback_link;?>">Your feedback form link: <strong><?php echo $feedback_link;?></a></strong></span>
            </div>
            <h1 class="text-xl text-indigo-800 text-bold my-10">Received feedback</h1>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            
            <?php
            
            if ( $feedback_data ) {
                foreach ($feedback_data as $data) { 
                    if ( $data['email'] == $user->data()->email ){
                    ?>
                    <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500"><?php echo $data['feedback']; ?></p>
                        </div>
                    </div>                
                <?php 
                    }
                } 
            }
            ?>
            </div>
        </div>

    </div>
</main>

<?php include_once 'includes/footer.php'; ?>

</body>
</html>