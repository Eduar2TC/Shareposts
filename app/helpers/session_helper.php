<?php
    session_start();
    //Flash message helper
    //Example - flash('register_success', 'you are now registered')
    //Display in View echo flash('register_success');
    function flash( $name = '', $message = '', $class = 'alert alert-success' ){
        if( !empty( $name ) ){
        
            if( !empty( $message ) && empty( $_SESSION[$name] ) ){

                if( !empty( $_SESSION[$name] ) ){
                    unset( $_SESSION[$name] );
                }

                if( !empty( $_SESSION[$name . '_class'] ) ){
                    unset( $_SESSION[$name . '_class'] );
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name.'_class'] = $class;

            }else if( empty( $message ) && !empty( $_SESSION[$name] ) ){
                $class = !empty($_SESSION[$name . '_class'] ) ? $_SESSION[$name . '_class'] : '';
                /*echo '<div class = "'.$class.'". id=" msg-flash " >'.
                        $_SESSION[$name]
                      .'</div>';*/
                      /*sobreecribir */
                echo '
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </symbol>
                </svg>
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
                    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-animation="true">
                        <div class="d-flex">
                            <div class="toast-body">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>'
                            .$_SESSION[$name].
                           '</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                ';
                /*echo  json_encode('resultado:'. $_SESSION[$name]);*/
                unset( $_SESSION[$name] );
                unset( $_SESSION[$name.'_class'] );
            }

        }
    }
    function isLoggedIn(){
        if( isset( $_SESSION['user_id'] ) ){
            return true;
        }else{
            return false;
        }
    }
?>