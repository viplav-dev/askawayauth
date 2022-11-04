<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($title) ? $title . " |" : ""  ?> AskAway</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/login_header.min.css"); ?>">
    <script src="https://kit.fontawesome.com/5e1d362a8f.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="headerContainer">
            <div class="headerLeftContainer">
                <a class="headerTitle" href="<?php echo base_url(); ?>">AskAway</a>
            </div>
            <div class="headerRightContainer">
                <!-- About us -->

                <!-- <a class="headerLinks " href="<?php echo base_url(); ?>account/signup">Don't have an account? Sign Up</a> -->
                <a class="ctaButton " href="<?php echo base_url(); ?>account/signin">Sign In</a>

            </div>
        </div>
    </header>
    <footer>
        <div class="footerContainer">
          
            <div class="footerRightContainer">
                <p style="display:inline;">&copy <a href="mailto:contact@viplav.dev">Viplav Pandhurnekar</a> </p>
            </div>


        </div>
    </footer>
</body>
<script>
    //dismiss alert after 5 seconds in js
    setTimeout(function() {
        document.getElementById("alert").style.display = "none";
    }, 5000);
</script>
<?php if (isset($_SESSION['toaster'])) { ?>
    <div class="alert" id="alert">
        <div class=" <?php echo $_SESSION['toaster']['status'] == 'true' ? 'alert-success' : 'alert-danger'; ?>">

            <strong><?php echo $_SESSION['toaster']['msg']; ?></strong>
        </div>
    </div>
<?php }
?>

</html>