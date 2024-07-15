<?php
session_start();
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged In";
    if ($_SESSION['role_as'] == 0) {
        header('Location: index.php');
    } else {
        header('Location: adminpanel/index.php');
    }
    exit();
}
include("userpanel/includes/header.php");
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="design/custom.js"></script>

<body background="img/2.png" style="width: -5%;">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" style="padding: 60px;">
                    <?php
                    if (isset($_SESSION['message'])) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Heyy!</strong> <?= sanitize($_SESSION['message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        unset($_SESSION['message']);
                    }
                    ?>

                    <style>
                        body {
                            background-image: url('img/bge.jpg');
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                        }
                    </style>
                    <div class="card">
                        <div class="card-header">
                            <h4 style="text-align: center; font-family: Gadugi;">Welcome To Vega Electronic Shop </h4>
                            <h6 style="text-align: center; font-family: Arial;">Login with your email and password</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= sanitize("functions/authcode.php") ?>" method="POST">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="&#xf0e0; Enter your email address" style="font-family:Arial, FontAwesome" id="exampleInputEmail1" aria-describedby="emailHelp" required="true" title="Enter your valid credentials">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="&#xf023; Enter your password" style="font-family:Arial, FontAwesome" id="exampleInputPassword1" required="true">
                                    <input type="checkbox" onclick="myFunction()" style="width: 20px; font-family: Arial;">Show Password
                                </div>


                                <button type="submit" name="login_btn" class="btn btn-outline-success">Sign In</button>
                                <button type="button" name="login_btn" class="btn btn-outline-success" onclick="window.location.href='registration.php'">Create Account</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("userpanel/includes/footer.php"); ?>
</body>