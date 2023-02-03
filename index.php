<?php
    // login.php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    session_start();
    if(isset($_SESSION['usuari'])){
        header("Location: home.php");
    }
    if(isset($_SESSION['register'])){
        echo "Usuari creat correctament";
        session_destroy();
    }

    if(isset($_POST['envia'])){        
        if(empty($username) || empty($password)){
            echo "Nom d'usuari o contrasenya incorrecta.";
        }else{
            require_once('connexio.php');
            try{
                $consultaUsuaris = "Select username,passHash from users where username = :nom and passHash = :contrasenya";
                $taulaUsuaris = $conn->prepare($consultaUsuaris);
                $taulaUsuaris->execute(array(':nom' => $username, ':contrasenya' => $password));
                $taula=$taulaUsuaris->rowCount();
                if($taula>0){
                    $_SESSION['usuari']=$_POST['username'];
                    header("Location: home.php");
                }else{
                    echo "Nom d'usuari o contrasenya incorrecta.";
                }
            }catch(PDOException $e){
                echo 'Error amb la BDs: '. $e->getMessage();
            }
        }
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
                                    <h2 class="fw-bold mb-2 text-uppercase">FAKELON</h2>
                                    <p class="text-white-50 mb-5">Entra el teu usuari i contrasenya per entrar!!</p>
                                    <form method="post"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
                                        <div class="form-outline form-white mb-4">
                                            <label for="username">Username:</label>
                                            <input type="text" id="username" name="username" class="form-control form-control-lg">
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-outline form-white mb-4">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg">
                                        </div>
                                        <br>
                                        <br>
                                        <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Login Up" name="envia" id="envia">
                                        <br>
                                        <br>
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-0">No tens un comte? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>