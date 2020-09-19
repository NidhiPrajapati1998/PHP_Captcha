<?php
    session_start();
    if(isset($_POST['submit1']))
    {
        $code = $_SESSION['captcha_code'];
        if($_POST['code'] == null)
        {?>
            <script>alert(`Pls enter captcha!!`);
            </script>
            <?php
        }
        elseif($_POST['code'] == $code)
        {?>
            <script>alert(`Captcha Match : )`);
            </script>
            <?php
        }
        elseif($_POST['code'] != $code)
        {?>
            <script>alert(`Captcha Mismatched : (`);</script>
            <?php
        }
    }
?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <form name="form" id="form" method="post" action="index.php">
    <table border='0' width='550px' cellpadding='0' cellspacing='10' align='center' >
    <div class="form-row">
        <tr>
            <td><label  id="lbl">Enter Text:</label></td> 
            <td><input type="text"  id="txt" display="none" name="txt_input" maxlength="50"></td>
            <td><button type="submit"  id="btn" onclick="onButtonClick()" name="submit" value="Create Captcha">Create Captcha</button> </td> 
        </tr> 

        <tr>
            <td></td>
            <td><?php
                if (!empty($_POST['txt_input'])) 
                {                    
                    $input_text = $_POST['txt_input'];
                    $_SESSION['captcha_code'] = $input_text;
                    $width = (strlen($input_text)*9)+20;
                    $height = 30;
                    
                    $textImage = imagecreate($width, $height);
                    $color = imagecolorallocate($textImage, 0, 0, 0);
                    imagecolortransparent($textImage, $color);
                    imagestring($textImage, 5, 10, 5, $input_text, 0xFFFFFF);
                    
                    // create background image layer
                    $background = imagecreatefromjpeg('bg.jpeg');
                    
                    // Merge background image and text image layers
                    imagecopymerge($background, $textImage, 15, 15, 0, 0, $width, $height, 100);
                    
                    $output = imagecreatetruecolor($width, $height);
                    imagecopy($output, $background, 0, 0, 20, 13, $width, $height);
                    
                    ob_start();
                    imagepng($output);
                    
                    printf('<img id="output" align="center" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean()));
                }
                ?></td>
                <?php
                if(isset($_POST['submit']))
                {
                if($_POST['txt_input'] == null)
                {?>
            <tr><td> </td>
                 <td><img  id="textInput1" src="captcha.php" width="150" height="50"></td> 
            </tr>
                <?php }} ?>

            <tr>
                <td><label  id="textInput2">Enter Capcha:</label></td> 
                <td><input  id="textInput3" type="text" name="code"  maxlength="50"></td> 
            </tr>

            <tr><td>  </td>
            <td><button  type="submit"  id="btn2"  name="submit1" value="Submit">Submit</button></td> 
            </tr>
    </div>
        </table>
    </form>
</body>        
</html>

