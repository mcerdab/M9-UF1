<?php
    //logout.php
    session_start();
    $username=$_SESSION['usuari'];
    require_once('connexio.php');
    try{
        $lastSignIn=date("Y-m-d H:i:s");
        $sql = "UPDATE users SET lastSignIn='$lastSignIn' where username ='$username'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':lastSignIn', $lastSignIn);
        $stmt->execute();
    }catch(PDOException $e){
        echo 'Error amb la BDs: '. $e->getMessage();
    }
    $_SESSION=array();
    session_destroy();
    setcookie(session_name(),"",time()-3600,"/");

    if(isset($_POST['envia'])){
        header("Location: index.php");
        die();
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
                                    <h1 class="fw-bold mb-2 text-uppercase">Logout</h1>
                                    <h3 class="fw-bold mb-2 text-uppercase">S'ha tancat la sessió</h3>
                                    <form method="post"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
                                        <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Login Up" name="envia" id="envia">
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