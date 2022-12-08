<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($title) ? $title . " |" : ""  ?> Password Manager</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/login_header.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/main.min.css"); ?>">
    <script src="https://kit.fontawesome.com/5e1d362a8f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</head>

<body style="background-color: #f8f9fa !important;">
   
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="<?php echo base_url("dashboard") ?>">Password Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="#">Learn More</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact Us</a>              
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item disabled" href="#">Payments</a></li>


                            </ul>
                        </li>
                        <a href="<?php echo base_url('account/logout') ?>" class="btn btn-danger">Sign out</a>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</body>
<script>
    //dismiss alert after 5 seconds in js
    setTimeout(function() {
        document.getElementById("alert").style.display = "none";
    }, 5000);
</script>
<?php if (isset($_SESSION['toaster'])) { ?>
    <div class="container" id="alert">
        <div class=" <?php echo $_SESSION['toaster']['status'] == 'true' ? 'alert alert-success alert-dismissible fade show' : 'alert alert-danger alert-dismissible fade show'; ?>">

            <strong><?php echo $_SESSION['toaster']['msg']; ?></strong>
        </div>
    </div>
<?php }
?>

</html>