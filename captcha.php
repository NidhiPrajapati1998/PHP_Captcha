<?php
    session_start();
    $random_alpha = md5(rand());
    /* Genrate s captcha of length 6 */
    $captcha_code = substr($random_alpha, 0, 6);
    $_SESSION['captcha_code'] = $captcha_code;
    /* Width and Height of captcha */
    $target_layer = imagecreatetruecolor(170,70);
    /* Captcha Text Color RGB */
    $captcha_text_color = imagecolorallocate($target_layer, rand(100, 200), rand(100, 200), rand(100, 200));
    /* Text size  */
    $font_size = 32;
    /* For Lines */
    for($i=0; $i<=10; $i++)
    {
        imageline($target_layer, rand(0,100), rand(0,100), rand(0,150), rand(0,100), $captcha_text_color);
    }
    /* For pixels */
    $pixel_color = imagecolorallocate($target_layer, 50, 50, 50);
    for($i=0; $i<1000; $i++)
    {
        imagesetpixel($target_layer,rand()%200, rand()%100, $pixel_color);
    }
    $font = dirname(__FILE__) . '/CALIFB.TTF';
    imagettftext($target_layer, $font_size, 8, 20, 60, $captcha_text_color, $font ,$captcha_code);
    header('Content-Type: image/png');
    imagepng($target_layer);
   
    ?>