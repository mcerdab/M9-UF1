<?php
    //home.php
    session_start();
    if(!isset($_SESSION['usuari'])){
        header("Location: index.php?redirected=true");
    }

    if(isset($_POST['envia'])){
        header("Location: logout.php");
    }
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
    <head>
        <title>Fakelon</title>
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="icon" href="logo.png" type="image/icon type">
    </head>
    <body>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h1 class="fw-bold mb-2 text-uppercase">Home</h1>
                                    <h3 class="fw-bold mb-2 text-uppercase">Ben volgut</h3>
                                    <img src="logo.png">
                                    <br>
                                    <br>
                                    <form method="post"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
                                        <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Logout" name="envia" id="envia">
                                    </from>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>