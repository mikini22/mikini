
<?php
session_start();
include ('header.php');
include ('helper.php');
$user = array();
if(isset($_SESSION['userID'])){
    require ('mysqlconnect.php');
    $user = get_user_info($con, $_SESSION['userID']);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Gallery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!--Get your own code at fontawesome.com-->
</head>
<body>
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <!-- Brand -->
  <a class="navbar-brand  font-ubuntu" id="f" href="indexx.php"><i class="fa fa-birthday-cake" aria-hidden="true"></i>  Cake Galleries</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse font-ubuntu" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="indexx.php">Home</a>
      </li>
        <div class="dropdown">
    <li class="nav-item">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#">Categories</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Cool Kids</a>
      <a class="dropdown-item" href="#">Hey Men</a>
      <a class="dropdown-item" href="#">Little Boys Range</a>
      <a class="dropdown-item" href="#">Little Girls Range</a>
      <a class="dropdown-item" href="#">Lovely Ladies</a>
      <a class="dropdown-item" href="#">Lovers Lane </a>
    </div>
    </li>
  </div>
  <div class="dropdown">
    <li class="nav-item">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#">Shop</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Cakes</a>
      <a class="dropdown-item" href="#">Cupcakes</a>
      <a class="dropdown-item" href="#">Pastries</a>
      <a class="dropdown-item" href="#">Desert</a>
    </div>
    </li>
  </div>
      <li class="nav-item">
        <a class="nav-link active" href="checkout.php">Checkout</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-danger" id="cart-item"></span></a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><h6 class="font-ubuntu">
        <div class="p-2 mt-2 text-capitalize">
                            <?php
                            if(isset($user['firstname'])){
                                printf('%s %s', $user['firstname'], $user['lastname'] );
                            }
                            ?>
                        </h6>
                          </div>                    
                <div class="user-info">
                    <ul class="font-ubuntu navbar-nav ">
                        <li class="nav-link p-1 text-primary"><?php echo isset($user['email']) ? $user['email']:'';?></span></li>
                    </ul>
                </div></a></li>
    </ul>
</nav>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
 include 'footer.php';
?>
</body>
</html>