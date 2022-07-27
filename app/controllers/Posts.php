<?php
    class Posts extends Controller{
        public function __construct(){
            if( !isLoggedIn() ){
                redirect('users/login');
            }
            //Init models to get dat from database
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }
        // public function index(){
        //     //Get Posts
        //     $posts = $this->postModel->getPosts();
        //     $data = [
        //         'posts' => $posts
        //     ];
        //     $this->view('posts/index', $data);
        // }
        //Limit number of posts showed on the main page
        public function index( $page_num = 1 ){
         
            $limit = 5;
            $total_rows = $this->postModel->countAllPost();
            $initial_page = ($page_num - 1) * $limit;
            $total_pages = ceil( $total_rows / $limit );

            if( isset( $page_num ) ){
                $posts = $this->postModel->getPostForRangueLimited($initial_page, $limit);
                $data = [
                    'posts' => $posts,
                    'page_num' => $page_num,
                    'total_pages' => $total_pages

                ];
                $this->view('posts/index', $data);
            }

        }
        public function add(){
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'title' => trim( $_POST['title'] ),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];
                
                //Validation of title
                if( empty( $data['title'] ) ){
                    $data['title_error'] = 'Please enter a title for your Post';
                }
                //Validation of post
                if (empty($data['body'])) {
                    $data['body_error'] = 'Please enter a text for body for your Post';
                }
                //Make sure no errors
                if( empty( $data['title_error'] ) && empty( $data['body_error'] ) ){
                    //Validated
                    if( $this->postModel->addPost( $data ) ){
                        flash('post_message', 'Post Added!');
                        redirect('posts');
                    }else{
                        die('Some wrong');
                    }

                }else{
                    //Load view with errors
                    $this->view('posts/add', $data);
                }

            }else{
                $data = [
                    'title' => '',
                    'body' => '',
                    'title_error' => '',
                    'body_error' => ''
                ];
                $this->view('posts/add', $data);
            }
        }
        public function edit( $id ){
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim( $_POST['title'] ),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];
                
                //Validation of title
                if( empty( $data['title'] ) ){
                    $data['title_error'] = 'Please enter a title for your Post';
                }
                //Validation of post
                if (empty($data['body'])) {
                    $data['body_error'] = 'Please enter a body text for for your Post';
                }
                //Make sure no errors
                if( empty( $data['title_error'] ) && empty( $data['body_error'] ) ){
                    //Validated
                    if( $this->postModel->updatePost( $data ) == true ){
                        flash('post_message', 'Post Update!');
                        redirect('posts');
                    }else{
                        die('Something went wrong');
                    }

                }else{
                    //Load view with errors
                    $this->view('posts/edit', $data);
                }

            }else{
                //Get existing post from model
                $post = $this->postModel->getPostById( $id );
                //Check for owner
                if( $post->user_id != $_SESSION['user_id'] ){
                    redirect('posts');
                }

                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'title_error' => '',
                    'body_error' => ''
                ];
                $this->view('posts/edit', $data);
            }
        }
        //Show post details
        public function show( $id ){
            $post = $this->postModel->getPostById( $id );
            $user = $this->userModel->getUserById( $post->user_id );
            $score_post = $this->postModel->getScorePostByUserId( $id, $_SESSION['user_id'] );
            $data = [
                'post' => $post,
                'user' => $user,
                'score_post' => $score_post
            ];
            $this->view('posts/show', $data);
        }
        //Delete post
        public function delete( $id ){
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

                $post = $this->postModel->getPostById( $id );
                //Check for owner
                if ($post->user_id != $_SESSION['user_id'] ) {
                    redirect('posts');
                }
                if( $this->postModel->deletePost( $id ) == true ){    
                    flash('post_message', 'Post removed!');
                    redirect('posts');
                }else{
                    die('Something went wrong');
                }
            }else{
                redirect('posts');
            }
        }
        public function like( $id ){
            if( $this->postModel->likePost($id, $_SESSION['user_id'] ) == true ){
                try{
                    //Get data post
                    $post = $this->postModel->getPostById($id);
                    $post = ['likes' => $post->likes, 'dislikes' => $post->dislikes];
                    echo returnJsonHttpResponse($post, 200);
                    return true;
                    
                }catch(PDOException $e){
                    echo returnJsonHttpResponse( $e->getMessage(), 500);
                    return false;
                }
            }else{
                die('Something went wrong');
            }
        }
        public function dislike( $id ){
            if( $this->postModel->dislikePost($id, $_SESSION['user_id'] ) == true ){
            try {
                //Get data post
                $post = $this->postModel->getPostById($id);
                $post = ['likes' => $post->likes, 'dislikes' => $post->dislikes];
                echo returnJsonHttpResponse($post, 200);
                return true;
            } catch (PDOException $e) {
                echo returnJsonHttpResponse($e->getMessage(), 500);
                return false;
            }
            }else{
                die('Something went wrong');
            }
        }
    }

?>
