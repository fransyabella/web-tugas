<?php

require_once "pdo.php";
$message='';
$failed='';
$error='';
if (isset($_POST['insert'])) {
    if ( isset($_FILES['img']) && isset($_POST['product_name']) && isset($_POST['color'])&& isset($_POST['size'])  && ($_POST['price'])){
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $imagesize=$_FILES['img']['size'];
        $valid_extensions = array('jpeg','jpg','png','pdf');
        $ext=explode('.',$img);
        $extfix=strtolower(end($ext));

        if (!in_array($extfix, $valid_extensions)){
            $failed = "Failed! Your file extension is " .$extfix. ". Please input only jpeg, jpg, png or pdf file";
        }
        else if($imagesize > 1048576){
            $failed ="Failed! Your file size : " .$imagesize. " is too big. File size required only less than 1 Mb";
        }
    
        else if (move_uploaded_file($tmp, 'images/' . $img)){
            $sql = "INSERT INTO products (product_name, color, size, price, img)
                    VALUES (:product_name, :color, :size, :price, :img)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':product_name' => $_POST['product_name'],
                ':color'=>$_POST['color'],
                ':size'=>$_POST['size'],
                ':price' =>  $_POST['price'],
                ':img'=> $img));
            $message = "Data succesfully add!";
        }
        else{
            $error="Failed to move files";
        }
    }
    else{
        $error="All fields are required";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <title>Product</title>
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
            <span class="menu-collapsed">
                <a href = "admin.php">ADMIN</a>
            </span>
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
        
        <div class="col-md-4 ml-5 mt-5 col-md-offset-4 form-login">
        <?php
        if ($message != ""){
            echo '<div class="alert alert-success" role="alert">' .$message.'</div>';
        }
        else if ($error != ""){
            echo '<div class="alert alert-danger" role="alert">' .$error.'</div>';
        }
        else if ($failed != ""){
            echo '<div class="alert alert-danger" role="alert">' .$failed.'</div>';
        }
        ?>
            <div class="ml-5 outter-form-login">
                
                <form method="post" class="inner-login" action="" enctype="multipart/form-data">
                    <h3 class="text-center title-login">Add Product</h3>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="product_id">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" ></p>
                    </div>
                    <p>Name
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_name" ></p>
                    </div>
                    <p>Color
                    <div class="form-group">
                        <input type="text" class="form-control" name="color"></p>
                    </div>
                    <p>Size
                    <div class="form-group">
                        <input type="text" class="form-control" name="size"></p>
                    </div>
                    <p>Price
                    <div class="form-group">
                        <input type="text" class="form-control" name="price"></p>
                    </div>
                    <p>Foto
                    <div class="form-group">
                    <input type="file" name="img"accept="*/image"></p>
                    </div>
                    <p><input type="submit" class="btn btn-primary"  value="Add new" name="insert"/></p>
        
                </form>
            </div>
        </div>
       

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>