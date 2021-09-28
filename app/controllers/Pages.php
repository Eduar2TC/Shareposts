<?php 
    class Pages extends Controller{
        private $postModel;
        public function __construct(){
            $this->postModel = $this->model('Post');
        }
        public function index(){
            //Chek if user is loged for redirect to post user
            if( isLoggedIn() == true ){
                redirect('posts');
            }else{
            //Show principal description
                $posts = $this->postModel->getPosts();
                $data = [
                    'title' => 'Welcome',
                    'description' => 'This is a description of post for MVC proyect',
                    'posts' => $posts
                ];
                $this->view('pages/index', $data);
            }
        }
        public function about( ){
        $data = [
            'title' => 'About',
            'description' => 'App to share post with other users'
        ];
            $this->view( 'pages/about', $data);
        }
    }
