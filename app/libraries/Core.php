<?php
    /*
    *App Core class 
    *Creates URL & loads Core Controller
    *URL FORMAT : /controllerName/MethodName/paramsFunction
    */
    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r( 'URL : ' .$this->getUrl() );
            $url = $this->getURL();
            /* -CONTROLLER */
            //Look in controllers for first value
            if( isset( $url[0] ) ){
                //Check file controller
                if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) { //ucwords converts for each word first letter to Uppercase
                    //If exist this Controller set this as controller current
                    $this->currentController = ucwords($url[0]);
                    //print_r($this->currentController);
                    //Unset 0 index array url (Controller)
                    unset($url[0]);
                }
            }
            //Require the controller
            require_once '../app/controllers/' . $this->currentController. '.php';
            //Instantiate the actual controller class
            $this->currentController = new $this->currentController;
            
            /* -METHOD */
            //Check for second part of url
            if( isset( $url[1] ) ){
                //Check to see if method exist in actual controller
                if( method_exists( $this->currentController, $url[1] ) ){
                    $this->currentMethod = $url[1];
                //Unset element position 1 index of array (Method)
                unset( $url[1] );
                }
            }

            /* -PARARAMS */
            //Get params
            $this->params = !empty( $url ) ? array_values( $url ) : []; // copy values of array $url to $params if its is no empty else params = '' 
            call_user_func_array( 
                [ $this->currentController,
                  $this->currentMethod 
                ],
                $this->params
            );
        }
        /*RETURN: CONTROLLER / METHOD / Params */
        public function getURL(){
            if( isset( $_GET['url'] ) ){
                $url = rtrim( $_GET['url'], '/' ); //Delete character in the end url
                $url = filter_var( $url, FILTER_SANITIZE_URL ); //delete special characters in the url
                $url = explode( '/', $url ); //convert url to array limited of slash
                return $url;
            }
        }
    
    
    }

?>