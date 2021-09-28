<?php
    class Users extends Controller{
        public function __construct(){
            //load model
            $this->userModel = $this->model('User');
        }
        //Redirect to home if url is sharepost/users
        public function index(){
            redirect('');
        }
        public function register(){
            //Check for Post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form
            //Sanitize Post data
                $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => '',
                    'styles' => ''
                ];
            //Validate Email
                if( empty( $data[ 'email' ] ) ){
                       $data['email_error'] = 'Please enter email';    
                }else{
                    //Check email is used in Controller
                    if( $this->userModel->findUserByEmail( $data['email'] ) == true ){
                        $data['email_error'] = 'Email already taken';
                    }
                }
            //Validate Name
                if ( empty($data['name'])) {
                    $data['name_error'] = 'Please enter your name';
                }
            //Validate Password
                if ( empty($data['password'])) {
                    $data['password_error'] = 'Please enter a password';
                }
                else if( strlen($data['password']) < 6 ){
                    $data['password_error'] = 'Password must be at least 6 characters';
                }
            //Validate confirm password
                if( empty( $data['confirm_password'] ) ){
                    $data['confirm_password_error'] = 'Please confirm password';
                }else{
                    if( $data['password'] != $data['confirm_password'] ){
                        $data['confirm_password_error'] = 'Password do not match';
                    }
                }

            //Make sure errors are empty
                if( empty( $data['email_error'] ) && empty( $data['name_error'] ) && empty( $data['password_error'] ) && empty( $data['confirm_password_error'] )  ){
                    //Is validated!
                    //Hash password
                    $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT );
                    if( $this->userModel->register( $data ) == true ){
                        flash('register_success', 'You are registered and can log in the website');
                        redirect('users/login');
                    }else{
                        die('Something wrong');
                    }
                }
                else{
                /* Change style input placeholder */
                $data['styles'] =
                    '<style>
                        .card .form-control::placeholder { 
                            color: red !important;
                            font-size: 0.95rem;
                        }
                    </style>';
                    //Load view with errors
                    $this->view( 'users/register', $data);
                }

            }
            else{
                //init data
                $data =[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => '',  
                ];
                //Load view
                $this->view('users/register', $data);
            }
        }
        public function login(){
            //Check for POST method
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            //Process form
                //Sanitize Post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => '',
                    'styles' => ''
                ];
                //Validate Email
                if( empty($data['email']) ) {
                    $data['email_error'] = 'Please enter email';
                }//Check if Email/User is found
                else if ( !empty($data['email']) ) {
                    if ($this->userModel->findUserByEmail( $data['email'] ) ) {
                        //User found!
                    } else {
                        //User no found
                        $data['email'] = '';
                        $data['email_error'] = 'User no found';
                    }
                }
                //Validate Password
                if(empty($data['password'])) {
                    $data['password_error'] = 'Please enter a password';
                }
                //Make sure errors are empty
                if( empty( $data['email_error'] ) && empty( $data['password_error'] ) ){
                    //Validated 
                    //Check and set logged in user
                    $loggedInUser = $this->userModel->login( $data['email'], $data['password'] );

                    if( $loggedInUser != false ){  //get row correct user and password
                        //Create session
                        $this->createUserSession( $loggedInUser );
                    }else{
                        $data['password'] = '';
                        $data['password_error'] = 'Password incorrect';
                        /* change style input placeholder */
                        $data['styles'] =
                        '<style>
                            .card .form-control::placeholder { 
                                color: red !important;
                                font-size: 0.95rem;
                            }
                        </style>';
                        $this->view('users/login', $data);
                    }

                }else{
                /* change style input placeholder */
                    $data['styles'] =
                    '<style>
                        .card .form-control::placeholder { 
                            color: red !important;
                            font-size: 0.95rem;
                        }
                    </style>';
                    //Load view with errors
                    $this->view('users/login', $data);
                }
            }
            else{
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];
            }

            //Load view
            $this->view('users/login', $data);
        }

        //Create session
        public function createUserSession( $user ){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
        public function profile( $id ){

            $this->userModel = $this->model('User');
            $dataUser = $this->userModel->getUserById($id);
            $data = [
                'data_user' => $dataUser
            ];
            //Redirect to login page is not logged
            if (!isLoggedIn()) {
                redirect('users/login');
            }else{
                $this->view('users/profile', $data);
            }
        }
    }
?>