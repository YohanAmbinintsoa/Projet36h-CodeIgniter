<?php
    include("errors/errors.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/animate.css'); ?>">
    <title>Log in</title>
</head>
<body>
    <div class="container">
        <div class="middle">
            <div class="img">
                <h2>Haven't an account yet?</h2>
                <button class="btn"><?php echo anchor('welcome/signup','Sign up'); ?></button>
            </div>
            <div class="form-container">
                <h1>Log into your account</h1>
                <?php echo form_open('formControll/Check','class="form"') ?>
                    <input type="text" name="user" id="" placeholder="Username" value="admin">
                    <input type="password" name="pass" id="" placeholder="Password" value="admin">
                    <input type="submit" value="Login">
                </form>
                <?php if(isset($_GET['error'])) { ?> 
                    <p class="error animate__animated animate__shakeX"><?php echo $error[$this->input->get('error')]; ?></p>
                <?php } ?>
                <?php if(validation_errors()!=" ") { ?>
                    <p class="error"><?php echo validation_errors() ?></p>
                <?php } ?>
            </div>
        </div>       
    </div>
</body>
</html>