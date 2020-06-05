<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href=index.css>
    <title>E-Commerce blabla</title>
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
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                   
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ">
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


<?php  
require_once "pdo.php";
session_start();  
 
 $unameadmin= 'admin';
 $passadmin= 'admin';
      if(isset($_POST['login']))  
      {  
        if(isset($_POST['username']) && isset($_POST['password'])){
			    if(($_POST['username'])== $unameadmin && ($_POST['password'])== $passadmin){
				    $query= "SELECT * FROM users WHERE username = '$unameadmin' AND password = '$passadmin';";  
				    $stmtadmin = $pdo->prepare($query);  
                    $stmtadmin->execute(  
                        array(  
                          '$unameadmin'     =>     $_POST["username"],  
                          '$passadmin'     =>     $_POST["password"]  ));
			        $count = $stmtadmin->rowCount();  
                        if($count > 0)  {  
                            $_SESSION["username"] = $_POST["username"];  
                            header("location:admin.php"); 
                            
                        }  
                        else  {  
                            ?>
                            <div class="alert alert-warning" role="alert">Failed to login, check your username and password again!</div>
                            <?php
                         }
                    }
			   
			    else  {
				    $query = "SELECT * FROM users WHERE username = :username AND password = :password"; 
                    $statement = $pdo->prepare($query);  
                    $statement->execute(  
                     array(  
                          ':username'     =>     $_POST["username"],  
                          ':password'     =>     $_POST["password"] ));
				    $count = $statement->rowCount();  
                    if($count > 0)  
                    {  
                        $_SESSION["username"] = $_POST["username"];  
                        $_SESSION['user_id'] = $_POST["user_id"];
                        header("location:index.php");  
                    }  
                    else  
                    {  ?>
                        <div class="alert alert-danger" role="alert">Failed to login, check your username and password again!</div>
                        <?php } 
        
            } }
            else if ( (empty($_POST["username"]) || empty($_POST["password"]))){
                ?>
                    <div class="alert alert-warning" role="alert">All fields are required</div>
                <?php
            } 
        }  
	  ?>
    
    
    
<div class="col-md-4 col-md-offset-4 form-login"></div>
    <div class="outter-form-login">
        <div class="logo-login">
            <em class="glyphicon glyphicon-user"></em>
        </div>
        <form action="" class="inner-login" method="post">
            <h3 class="text-center title-login">Login Member</h3>

            <div class="form-group">
                <input type="hidden" class="form-control" name="user_id">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="text-center forget">
                <p>Forgot Password ?</p>
            </div>

            <input type="submit" class="btn btn-block btn-custom-green" value="LOGIN" name="login" />
            
            <div class="text-center forget">
                <p>Do you haven't account yet? <a href="#">Register First</a></p>

            </div>
        </form>
    </div>
</div>
    <footer id="footer">
        <p>
            Created by
            <a href="https://github.com">GIthub</a>
        </p>

    </footer>
</body>
</html>
   