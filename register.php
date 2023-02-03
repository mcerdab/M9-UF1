<?php
    //register.php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $password_verify = $_POST['password_verify'];
    }

    if(isset($_POST['envia'])){
        if(empty($username) || empty($email) || empty($first_name) || 
        empty($last_name) || empty($password) || empty($password_verify)){
            echo "Si us plau entreu totes les dades.";
        } else {
            if($password != $password_verify){
                echo "Passwords no són iguals, torna a intentar si us plau.";
            }else{
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "El correu esta mal escrit.";
                }else{
                    require_once('connexio.php');
                    try{
                        $num=1;
                        $consultaEmail="Select email from users";
                        $taulaEmail = $conn->query($consultaEmail);
                        if($taulaEmail){
                            foreach($taulaEmail as $fila){
                                echo $fila['email'];
                                if($fila['email']==$email){
                                    $num=0;
                                    echo "El correu ja esta registrat.";
                                    break;
                                }
                            }                            
                        }
                        if($num==1){
                            $CreationDate = date("Y-m-d H:i:s");
                            $sql = "INSERT INTO users (mail,username,passHash,userFirstName,userLastName,creationDate,active) 
                                    VALUES ('$email','$username','$password','$first_name','$last_name','$CreationDate',1)";     
                            $stmt = $conn->query($sql);
                            if($stmt){
                                session_start();
                                $_SESSION['register']='1';
                                header("Location: index.php");
                                die();
                            }
                        }
                    }catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    
                }
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
                                    <form method="post"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
                                        <div class="form-outline form-white mb-4">
                                            <label for="username">Username:</label>
                                            <input type="text" id="username" name="username" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label for="email">Email:</label>
                                            <input type="text" id="email" name="email" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label for="password_verify">Verify Password:</label>
                                            <input type="password" id="password_verify" name="password_verify" class="form-control form-control-lg">
                                        </div>
                                        <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Sign Up" name="envia" id="envia">
                                    </form>
                                </div>
                                <div>
                                    <p>Have an account? <a href="./index.php">Login Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>