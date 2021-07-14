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
                        <li class="nav-link p-1 text-primary"><span><?php echo isset($user['email']) ? $user['email']:'';?></span></li>
                    </ul>
                </div></a></li>
    </ul>
</nav>
<style>
  
.mine {
    
  position: relative;
  text-align: center;
  color: white;
  width: 100%;
  padding: 0;
  margin: 0;
  height: 300px;
  
}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.net{
    width: inherit;
    height: inherit;
}
@import url('https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@300&display=swap');
:root{
    --font-ubuntu:'Ubuntu',monospace;
    
}
.font-mikini{
    font: normal 500 60px var(--font-ubuntu);
}
.font-tope{
    font: normal 500 30px var(--font-ubuntu);
}
.nine{
  color: rgb(218, 135, 28);
}
@import url('https://fonts.googleapis.com/css2?family=Yellowtail&display=swap');
:root{
    --font-mikini:'Yellowtail', cursive;
    
}
.font-kemi{
    font: normal 500 80px var(--font-mikini);
}


</style>
</head>
<body>
   
<div class="mine">
  <img src="img/deletee.jpg" alt="Snow" class="net ">
  <div class="centered font-kemi nine">Cakes</div>
</div>
<div class="row pt-3 mt-2">
<?php
include 'sqlconnect.php';
$stmt = $con->prepare("SELECT * FROM product");
$stmt->execute();
//result
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()): {
  
}
$id =$_GET['id'];
$sql = "SELECT * FROM products WHERE id =$id";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)>0) {
  $row = mysqli_fetch_assoc($result);
}
?>
<div class=" col-sm-6 col-md-4 col-lg-3 one mb-2 ">
    <div class="card-deck">
        <div class="py-2 mb-2">
          <a href="cakes.php?id='2757'"<?php if ($row['product_name']== "Chocolate cake") {
          }?>><img src="img/cake.jpg" class="card-img-top rounded" id="f" height="350"></a>
            <div class="card-body p-1">
              <h6 class="card-title text-center text-info font-ubuntu"><?= $row['product_name']?></h6>
  
            </div>
            <div class="card-body p-1">
              <h5 class="card-text text-center text-danger font-ubuntu"><span>&#8358
<?= number_format($row['product_price'],2 )?></h5></span>
</div>
<div class="card-footer p-1">

  <form action="" class="form-submit">
    <input type="hidden" class="pid" value="<?=$row['id']?>">
    <input type="hidden" class="pname" value="<?=$row['product_name']?>">
    <input type="hidden" class="pprice" value="<?=$row['product_price']?>">
    <input type="hidden" class="pimage" value="<?=$row['product_image']?>">
    <input type="hidden" class="pcode" value="<?=$row['product_code']?>">
    <button type="submit" class=" font-ubuntu time btn btn-info btn-block addItemBtn"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
  </form>
</div>
        </div>
    </div>
</div>
<?php endwhile; ?> 
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
              <footer class="kemi">Copyright 2020 © Cake Galleries. All rights reserved.@Mikini</footer>
        <!-- Footer End -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
 include 'footer.php';
?>
</html>