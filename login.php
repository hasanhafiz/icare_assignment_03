<?php 
    include_once 'core/init.php';
    
    if ( Session::exists('user') ) {
        Redirect::to('dashboard.php');        
    }
    
    // exit;  
    if ( Input::exists() ) {        

        $validate = new Validate(); 
        $validate->check( $_POST, ['email','password'] );       
        if ( $validate->passed() ) {               
            $user = new User;
            $login = $user->login( Input::get('email'), Input::get('password') );
            if ( $login ) {
                // $user_data = $user->get( Input::get('email') );
                Session::flash('success', 'You logged in successfully!');
                echo 'Success!';
                Redirect::to('index.php');
            } else {
                echo "Sorry! Logging is failed!";
            }  
        }                  
    }    
?>
<?php include_once 'includes/header.php'; ?>

<body class="bg-gray-100">

<?php include_once 'includes/navbar.php'; ?>

<main class="">
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-xl">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="mx-auto w-full max-w-xl text-center px-24">
                        <h1 class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</h1>
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
                    <?php if ( Session::exists('success') ) { ?>
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success !</span> <?php echo Session::get('success'); ?>
                        </div>
                    </div>
                     <?php } ?>   
                                    
                        <form class="space-y-6" action="" method="POST">
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" value="<?php echo Input::get('email');?>" autocomplete="email" required class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="text-sm">
                                        <a href="changepassword.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" value="<?php echo Input::get('password');?>" autocomplete="current-password" required class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>                                                    
                            
                            <div>
                                <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                            </div>
                        </form>
                        
                        <p class="mt-10 text-center text-sm text-gray-500">
                            Not a member?
                            <a href="register.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register now!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include_once 'includes/footer.php'; ?>

</body>
</html>