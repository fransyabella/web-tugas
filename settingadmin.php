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

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <title>User</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <svg class="bi bi-person-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
              </svg>
            <span class="menu-collapsed">ADMIN</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
          </a>
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        <a class="dropdown-item" href="admin.php">Dashboard</a>
                        <a class="dropdown-item" href="#">Profile</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>


    <div class="row" id="body-row">
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-dashboard fa-fw mr-3"></span>
                        <span class="menu-collapsed">Dashboard</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenu1' class="collapse sidebar-submenu">
                    <a href="useradmin.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Users</span>
                    </a>
                    <a href="productadmin.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Products</span>
                    </a>
                    <a href="addproduct.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Add Products</span>
                    </a>
    
                </div>
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenu2' class="collapse sidebar-submenu">
                    <a href="settingadmin.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Settings</span>
                    </a>
                    <a href="logoutadmin.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Logout</span>
                    </a>
                </div>

            </ul>
        </div>
        <!-- End Sidebar -->
        
                    <div class="card">
                       <div class="card-body text-center">
                       
                            <h3>Hello, <?php echo  $_SESSION['username'] ?></h3>
                            <h5>Would you like to edit your profile info? </h5>
                            <br>
                            <form action="settingadmin.php?edit=<?php echo $_SESSION['user_id'];?>" method="post">
                                <input type="submit" class="btn btn-success btn-lg" value="Edit Profile" name="edit" />
                                <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                            </form>
                            <?php
        if ($message != ""){
                echo '<div class="alert alert-success" role="alert">' .$message.'</div>';
            }
            else if ($error != ""){
                echo '<div class="alert alert-danger" role="alert">' .$error.'</div>';
            }?>
                     
                        </div>
                       
                        </div>

                
                <?php
            

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
        
                    <div class="outter-form-login ml-5" >
                   
           
                        <div class="logo-login">
                            <em class="glyphicon glyphicon-user"></em>
                        </div>
                            <form method="post" class="inner-login" action="settingadmin.php?update=<?php echo $userid?> ">
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
                
         
       

        <!-- MAIN -->
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>