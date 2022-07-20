<?php
/* Parametters: User name */
    function make_avatar( $name ){
        header('Content-Type: image/png');
        ini_set("log_errors", 1);
        ini_set("error_log", "php-error.log");
        $time = time();
        $path = APP_ROOT . '/views/users/img/tmp/' . $name .'-'. $time .'.png';
        $avatar = imagecreatetruecolor(200, 200);
        $bgcolor = imagecolorallocate( $avatar, rand(0, 255), rand(0, 255), rand(0, 255) );
        imagefill( $avatar, 0, 0, $bgcolor );
        $textcolor = imagecolorallocate($avatar, 255, 255, 255 );
        $font = APP_ROOT . '/views/users/img/tmp/Roboto-Bold.ttf';
        imagettftext( $avatar, 100, 0, 55, 150, $textcolor, $font, strtoupper($name[0]) );
        imagepng( $avatar, $path);
        imagedestroy( $avatar );
        $path = '/app/views/users/img/tmp/' . $name . '-' . $time . '.png';
        return $path;   
    }
?>