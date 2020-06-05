<?php
require_once "pdo.php";
session_start();
$message='';
$error='';
if (isset($_POST['update'])){
    $session_uname = $_SESSION['username'];
    $username=$_POST['username'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql = "UPDATE users SET username = '$username', name = '$name' , email = '$email', password = '$password' WHERE username = '$session_uname'"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    //use password_verify();
   if($pdo){
       $message = 'Your profile is successfully updated';
   }
   else{
       $error = 'Update failed, please try again!';
   }}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Setting</title>
  </head>
  <body>
  <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">blabla</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="product.html">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.html">History Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.html">Transaction</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ">
                    <li class="nav-item  active">
                        <a class="nav-link" href="setting.php">Setting<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">

                    <img class="img img-responsive rounded-circle mb-3" width="160" src="img/" />
                    
                    <h3>Hello, <?php echo  $_SESSION['username'] ?></h3>
                    <h5>Would you like to edit your profile info? </h5>
                    <br>
                    <form action="setting.php?edit=<?php echo $_SESSION['user_id'];?>" method="post">
                        <input type="submit" class="btn btn-success btn-lg" value="Edit Profile" name="edit" />
                        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                    </form>
                     
                </div>
            </div>    
        </div>

        <div class="col-md-8">     
            <?php
            if ($message != ""){
                echo '<div class="alert alert-success" role="alert">' .$message.'</div>';
            }
            else if ($error != ""){
                echo '<div class="alert alert-danger" role="alert">' .$error.'</div>';
            }

            if (isset($_POST['edit']) ){
                if ( isset($_GET['edit']) ) {
                    $session_uname = $_SESSION['username'];
                    $sql="SELECT * FROM users WHERE username = '$session_uname'";
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute(array('$session_uname' => $_GET['edit']));
                    $ambildata=$stmt->fetch();
                    $username=$ambildata['username'];
                    $name=$ambildata['name'];
                    $email=$ambildata['email'];
                    $password=$ambildata['password'];
                    $address=$ambildata['address'];
                    $phonenum=$ambildata['phonenum'];
                    ?>
        
                    <div class="outter-form-login">
                        <div class="logo-login">
                            <em class="glyphicon glyphicon-user"></em>
                        </div>
                            <form method="post" class="inner-login" action="setting.php?update=<?php echo $userid?> ">
                                <p>Username
                                <input type="text"class="form-control" name="username" value="<?php echo $username;?>"> 
                                <p>Password
                                <input type="password" name="password" class="form-control col-4" value="<?php echo $password;?>" id="password">  
                                <p>Name
                                <input type="text" name="name" class="form-control" size="40" value="<?php echo $name;?>"></p>
                                <p>Email
                                <input type="text" name="email" class="form-control" value="<?php echo $email;?>"></p>
                                <p>Address
                                <input type="text" name="email" class="form-control" value="<?php echo $address;?>"></p>
                                <p>Phonenum
                                <input type="text" name="email" class="form-control" value="<?php echo $phonenum;?>"></p>
                                
                                <input type="submit" class="btn btn-primary" value="Update" name="update"/>
                                <input type="submit" class="btn btn-primary"value="Cancel" name="cancel"/>
                            </form>
                    </div>
                    <?php
                } 
            } ?>
       
        </div>
    </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>