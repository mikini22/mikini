<?php
session_start();
include ('helper.php');
$user = array();
if(isset($_SESSION['userID'])){
    require ('mysqlconnect.php');
    $user = get_user_info($con, $_SESSION['userID']);
}
?>
<?php
require 'sqlconnect.php';

$grand_total = 0;
$allItems = '';
$items= array();

$sql = "SELECT CONCAT(product_name , '(',qty,')') AS ItemQty, total_price FROM cart ";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row=$result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(",", $items);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
                        <li class="nav-link p-1 text-primary"><b></b><span><?php echo isset($user['email']) ? $user['email']:'';?></span></li>
                    </ul>
                </div></a></li>
    </ul>
</nav>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h6 class="text-center text-info p-2">Complete your order</h6>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Cake(s) : </b><?=$allItems?></h6>
                <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                <h5><b>Amount Payable : </b><span>&#8358 <?= number_format ($grand_total,2 )?></h5></span>
                <form action="" method="post" id="placeOrder" >
                    <input type="hidden" name="products" value="<?=$allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?=$grand_total ;?>">
                <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
             <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-mail" required>
            </div>
            <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone number" required>
            </div>
            <div class="form-group">
                <textarea name="address" class="form-control" cols="10" rows="3" placeholder="Enter Delivery Address Here........"></textarea>
            </div>
            <h6 class="text-center lead">Select payment mode</h6>
            <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
            <div class="form-group">
                <input type="submit" value="Place Order" name="submit" class="btn btn-danger btn-block">
            </div>
                </form>
        </div>
        </div>
    </div>
</div>
<style>
 .fine{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #ffffff;
}

a {
    transition: .3s;
}

a:hover,
a:active,
a:focus {
    outline: none;
    text-decoration: none;
}

.footer {
    position: relative;
    padding-top: 45px;
    background: #121518;
    height: auto;
    width: auto;
}

.footer .footer-about,
.footer .footer-contact,
.footer .footer-links,
.footer .footer-project {
    position: relative;
    margin-bottom: 45px;
    color: #999999;
}

.footer .footer-about h3,
.footer .footer-contact h3,
.footer .footer-links h3,
.footer .footer-project h3 {
    position: relative;
    margin-bottom: 5px;
    padding-bottom: 5px;
    font-size: 15px;
    font-weight: 600;
    color: #eeeeee;
}

.footer .footer-about h3::after,
.footer .footer-contact h3::after,
.footer .footer-project h3::after {
    position: absolute;
    content: "";
    width: 50px;
    height: 2px;
    left: 0;
    bottom: 0;
    background: #eeeeee;
}
.footer .footer-links h3::after{
  position: absolute;
    content: "";
    width: 50px;
    height: 2px;
    left: 0;
    bottom: 0;
    background: #eeeeee;
}
.fifty{
  display:block;
    width:400px;
    word-wrap:break-word;
    }
    .kemi{
      background-color: rgb(110, 73, 73);
      height: auto;
      font-family: Arial, Helvetica, sans-serif;
      text-align: center;
      font-size: 20px;
      color: #999999;

    }
</style>
<div class="footer fine ">
            <div class="container">
                <div class="row">
                  <div class="footer-links fifty">
                <h3 class="">Shops</h3>   
             <li><a class="" href="#">Cool Kids</a></li>
             <li><a class="" href="#">Hey Men</a></li>
             <li><a class="" href="#">Little Boys Range</a></li>
             <li><a class="" href="#">Little Girls Range</a></li>
             <li><a class="" href="#">Lovely Ladies</a></li>
             <li><a class="" href="#">Lovers Lane</a></li>
                
                  </div>
                  <div class="footer-about fifty">
              <h3>About Us</h3>
              <p class="">Nuts About Cakes is a full service bakery that consistently delivers superior quality in cakes, pastries, bread and desserts. We have been in the business of delighting taste buds for over 10 years.</p>   
              <p>Head Branch: 33 Fola Osibo Street, Lekki Phase 1. Lagos. Nigeria.See All Our Branches</p>  
                  </div>
                  <div class="footer-contact fifty">
              <h3>Contact Us</h3>
              <p>+234 80929201019</p>
              <p>Email: <a href="">cakegalleries@gmail.com</a></p>
                  </div>
                </div>
            </div>
              </div>
              <footer class="kemi">Copyright 2020 © Cake Galleries. All rights reserved. @Mikini </footer>
        <!-- Footer End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include 'footer.php';
?>
</body>
</html>
