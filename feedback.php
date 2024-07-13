<?php 
require_once 'core/init.php';

if ( Input::get('user_id') ) {
    $user = new User;
    $user_exits = $user->getByID( Input::get('user_id') );
    
    if ( ! $user_exits ) {
        Redirect::to('dashboard.php');
    }
} 

if ( Session::exists( 'user' ) ){
    $user = new User();
    $user_data = $user->get( Session::get('user') );    
}

if ( Input::exists() ) {  
    $validate = new Validate();
    $validate->check( $_POST, ['feedback'] );
    
    if ( $validate->passed() ) {       
        // $user = new User();                             
        $feedback = new Feedback();
        $feedback->create([
            'user_id' => $user->data()->user_id,
            'email' => $user->data()->email,
            'feedback' => Input::get('feedback')
            ]);
        
        if ( $feedback ) {
            // redirect to index php 
            Session::flash('success', 'Your Feedback received successfully!');
            echo 'Success';
            Redirect::to( location: 'feedback-success.php');
        } else {
            echo "Sorry! Logging is failed!";
        }        
    }
}
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
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-xl">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="mx-auto w-full max-w-xl text-center">
                        <h1 class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</h1>
                        <h3 class="text-gray-500 my-2">Want to ask something or share a feedback to "<?php echo $user->data()->username; ?>"?</h3>
                    </div>
                    
                    <div class="mt-10 mx-auto w-full max-w-xl">
                        <?php                     
                            // print_r( $validation );
                            echo '<ul>';
                            if ( Input::exists() ) {
                                foreach ($validate->errors() as $error) {
                                    echo '<li class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> ' . $error . ' </li>';
                                }
                            }
                            echo '</ul>';
                            echo '<br/>';
                        ?>                    
                        <form novalidate class="space-y-6" action="#" method="POST">
                            <div>
                                <label for="feedback" class="block text-sm font-medium leading-6 text-gray-900">Don't hesitate, just do it!</label>
                                <div class="mt-2">
                                    <textarea required name="feedback" id="feedback" cols="30" rows="10" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo Input::get('feedback'); ?></textarea>
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once 'includes/footer.php'; ?>

</body>
</html>