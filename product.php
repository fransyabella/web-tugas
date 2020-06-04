<?php
require_once "pdo.php";
$stmt = $pdo->query("SELECT product_id, product_name, category, price, img FROM products");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


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
                    <li class="nav-item active ">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">History Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php">Transaction</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="loginuser.php">Login<span class="sr-only">(current)</span></a>
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
   
    <div class="container-fluid">
    <div class="row">
    <?php
        foreach ( $rows as $row ) {
    ?> 
        <div class="col-md-4">
				<div class="bg-primary text-center text-white">.col-md-4</div>
                <img src="images/<?=($row['img'])?>" width='100'height='100'>
                    <?=($row['product_name'])?>
                    <br>
                     <?=($row['category'])?>
                    <br>
                    <?=($row['price'])?></td>
                    <br>
                    <form action="transaction.php?buy=<?php echo $row['product_id'];?>" method="post">
                        <input type="hidden" name="user_id" value="<?=$row['product_id']?>">
                        <input type="submit" value="Buy" name="buy">
                     </form>
        </div>
        <?php
        }
    ?>
        </div>
        </div>
    
                
                
                
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <footer id="footer">
        <p>
            Created by
            <a href="https://github.com">GIthub</a>
        </p>

    </footer>
</body>

</html>