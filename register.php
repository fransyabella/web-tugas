
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
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item   active">
                        <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <div class="col-md-4 col-md-offset-4 form-login"></div>
    <div class="outter-form-login">
        <div class="logo-login">
            <em class="glyphicon glyphicon-user"></em>
        </div>
        <form action="register.php" class="inner-login" method="post">


<?php
require_once "pdo.php";
$psword="";
$message='';
if ( isset($_POST['register'])) {
    if ($_POST['username']==""){
        $message = 'Username field is required!';
    } elseif ($_POST['password']==""){
        $message = 'Password field is required!';
    } elseif ($_POST['name']==""){
        $message = 'Name field is required!';
    } elseif ($_POST['email']==""){
        $message = 'Email field is required!';
    } elseif ($_POST['address']==""){
        $message = 'Address field is required!';
    } elseif ($_POST['phonenum']==""){
        $message = 'Phone Number field is required!';
    }else{
        $sql = "INSERT INTO users (username,password,name, email, address,phonenum) 
              VALUES (:username, :password, :name, :email, :address, :phonenum)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':username' => $_POST['username'],
            ':password' => $_POST['password'],
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':address' => $_POST['address'],
            ':phonenum' => $_POST['phonenum']));
        ?>
            <div class="alert alert-success" role="alert">Register success, try login </div>
        <?php
        header("location:login.php");
        }}
if ($message != ""){
    
    echo '<div class="alert alert-danger" role="alert">Register failed,' .$message.'</div>';
     
}
    ?>
            <h3 class="text-center title-login">Register Member</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phonenum" placeholder="phone number">
            </div>

            <input type="submit" class="btn btn-block btn-custom-green" value="Register" name="register" />
            <div class="text-center forget">
                <p>Already have account <a href="#">Login</a></p>

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