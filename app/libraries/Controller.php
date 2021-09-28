<?php
/*
    *Base Controlller
    *Load the model and views
*/
class Controller {
    //Load model
    public function model( $model ){
        //Require model file
        require_once '../app/models/' . $model. '.php';
        //Instantiated model
        return new $model();
    }

    //Load view
    public function view( $view, $data = [] /* <- data for this view */ ){
        //Check for view file
        if( file_exists('../app/views/'. $view . '.php') ){
            require_once( '../app/views/' . $view . '.php' );
        }else{
            //View no exist
            die('View not exists');
        }
    }

}