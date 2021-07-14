
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
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  @import url('https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@300&display=swap');
:root{
    --font-ubuntu:'Ubuntu',monospace;
    
}
.font-mikini{
    font: normal 500 60px var(--font-ubuntu);
}
.font-tope{
    font: normal 500 40px var(--font-ubuntu);
}
.nine{
  color: rgb(218, 135, 28);
}
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}
/* Float four columns side by side */
.flirt {
  float: left;
  width: 25%;
  padding: 0 20px;
}

/* Remove extra left and right margins, due to padding */
.row1 {
  margin-left: 120px;
padding: 10px;
}
.row2 {
  margin-left: 120px;
padding: 10px;
}

/* Clear floats after the columns */
.row1:after {
  content: "";
  display: table;
  clear: both;
}
/* Clear floats after the columns */
.row2:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
/* Responsive columns */
@media screen and (max-width: 600px) {
  .flirt {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  padding: 16px;
  text-align: center;
}
.cod{
  background-color: #f1f1f1;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 10px;


}
.avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
.karan {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.flirt {
  transition: all 0.3s ease-in-out 0s
}
.flirt:hover {
  transform: rotateX(360deg);
}

  </style>
<body>
<div id="message"></div>
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/bg_11.jpg" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
      <h6 class="mine">Quality </h6>
        <p class="font-family">is our recipe</p>
        <input type="button" value="Buy Cupcake!! "class=" color btn btn-dark font-ubuntu ">
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/99.jpg" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h6 class="font-family">Mouth Wathering </h6>
        <p class="font-family">Cakes</p>
        <p class="font-ubuntu">As low as <span>&#8358 10,000</p></span>

        <input type="button"  class="color btn btn-light font-ubuntu" value="Shop cakes now!!">
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/pastriess.jpg" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
      <h6 class="mine black" >One bite </h6>
      <p class="font-family black">And You'll overule all objections</p>
      <input type="button"  class="color btn btn-info font-ubuntu" value="BUY PASTRIES">

      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div class="cod">
  <h4 class="text-center font-tope nine"><i class="fa fa-motorcycle" aria-hidden="true"></i> WE DELIVER EVERYWHERE IN LAGOS</h4>
<div class="row1">
  <div class="column one">
        <a href="cakess.php"><img src="img/hot.jpg" alt="Chicago" width="1100" height="500" class="avatar"></a>
      <p class="px-3 font-ubuntu">Cakes</p>
  </div>
  <div class="column one">
  <img src="img/menu1.jpg" alt="Chicago" width="1100" height="500" class="avatar">
  <div class="">
      <p class="px-3 font-ubuntu">Cupcakes</p>
    </div>
  </div>
  
  <div class="column one">
  <img src="img/b4.jpg" alt="Chicago" width="1100" height="500" class="avatar">
  <div class="">
      <p class="px-3 font-ubuntu">Pastries</p>
    </div>
  </div>
  
  <div class="column one">
  <img src="img/b1.jpg" alt="Chicago" width="1100" height="500" class="avatar ">
  <div class="">
      <p class="px-3 font-ubuntu ">Desert</p>
    </div>
  </div>
  
</div>
</div>
<h4 class="text-center text-capitalize font-mikini nine">Our Bestsellers</h4>
<style>
.carousel-caption {
  position: absolute;
  top: 0;
  bottom: auto;
  text-align: center;  
  width: 500px;
  padding : 20px;
  font-size: xx-large;
  font-family: Impact, 'Arial Narrow Bold', sans-serif;

}
.mine{
  font-size: 100px;
  font-style: italic;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.color{
  color: brown;
  font-size: larger;
  background: black;
  border: none;
}
@import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');

:root{
    --font-family: 'Playball', cursive;
    --color-border: rgb(248, 247, 247);
    
}

.font-family{
    font: normal 500 53px var(--font-family);
}
.black{
    color: rgb(82, 35, 4);
    
  }

.time{
  background: orange;
  border: none;
  box-shadow: none;
}
</style>
<div class="container">
  <div class="row pt-3 mt-2">
<?php
include 'sqlconnect.php';
$stmt = $con->prepare("SELECT * FROM product");
$stmt->execute();
//result
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()): {
  
}

?>
<div class=" col-sm-6 col-md-4 col-lg-3 one mb-2 ">
    <div class="card-deck">
        <div class="p-2 mb-2">
            <img src="<?= $row['product_image']?>" class="card-img-top rounded" id="f" height="350">
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
<div class="cod">
<div class="row2">
<div class="flirt">
        <a href="#"><img src="img/ttt.jpg" alt="Chicago" width="1100" height="500" class="karan"></a>
  </div>
  <div class="flirt ">
  <a href="#"><img src="img/facebookk.png" alt="Chicago" width="1100" height="500" class="karan"></a>
  </div>
  
  <div class="flirt">
  <a href="#"><img src="img/instagram.jpg" alt="Chicago" width="1100" height="500" class="karan"></a>
  </div>
  
  <div class="flirt">
 <a href="https://wa.link/6z6ul7"><img src="img/whatsapp3.png" alt="Chicago" width="1100" height="500" class="karan "></a>
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
</html>
