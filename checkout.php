<?php
session_start();
include ('helper.php');
$user = array();
if(isset($_SESSION['userID'])){
    require ('mysqlconnect.php');
    $user = get_user_info($con, $_SESSION['userID']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('actions.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('verify_transaction.php');
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="mikini.css" >
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="paris.css" >
    <link rel="stylesheet" href="serious.css" >
    <link rel="stylesheet" href="serious.css" >

<!--Get your own code at fontawesome.com-->
</head>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ minDate: 2, maxDate: "+1M +10D" });
    $( "#anim" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  } );
  
  </script>
<body>
<nav class="navbar navbar-expand-md bg navbar-light">
  <!-- Brand -->
  <a class="navbar-brand m-0" href="#"><img src="img/logo.jpg" class="avatars" alt="" srcset=""></a>

  <a class="navbar-brand  font-ubuntu" id="f" href="indexx.php">Cakes Gallery</a>

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
    <div class="dropdown-menu font-ubuntu">
      <a class="dropdown-item" href="grab.php">Grab & Go </a>
      <a class="dropdown-item" href="fondant.php">Fondant Cakes</a>
      <a class="dropdown-item text-capitalize" href="#">Dessert cakes</a>
    </div>
    </li>
  </div>
  <li class="nav-item">
        <a class="nav-link active" href="wedding.php">Weddings</a> 
      </li>
      <div class="dropdown">
    <li class="nav-item">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#">Shop</a>
    <div class="dropdown-menu font-ubuntu">
      <a class="dropdown-item" href="different.php">Cakes</a>
      <a class="dropdown-item" href="#">Cupcakes</a>
      <a class="dropdown-item" href="#">Pastries</a>
      <a class="dropdown-item" href="#">   dessert</a>
    </div>
    </li>
  </div>

      <li class="nav-item">
        <a class="nav-link active" href="checkout.php">Checkout</a> 
      </li>
      <li class="nav-item mt-0">
        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"  aria-hidden="true"></i><sup><span class="badge badge-danger " style="height: 14px;" id="cart-item"></span></sup></a>
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
<?php
				if(ISSET($_SESSION['status'])){
					if($_SESSION['status'] == "ok"){
			?>
						<div class="alert alert-info"><?php echo $_SESSION['result']?></div>
			<?php
					}else{
			?>
						<div class="alert alert-danger"><?php echo $_SESSION['result']?></div>
			<?php
					}
 
					unset($_SESSION['result']);
					unset($_SESSION['status']);
				}
			?>
<div class="container">

    <div class="row justify-content-center font-ubuntu">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h6 class="text-center text-info p-2 font-paris">Complete your order</h6>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Cake(s) : </b><?=$allItems?></h6>
                <h6 class="lead"><b> For Delivery Charge : </b>Call or Message @ <a href="https://wa.link/6z6ul7">+2348023703404</a></h6>
                <h5><b>Amount Payable : </b><span>&#8358 <?= number_format ($grand_total,2 )?></h5></span>
                <form action="" method="post" id="placeOrder" >
                    <input type="hidden" name="products" value="<?=$allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?=$grand_total ;?>">
                <div class="form-group">
            <input type="text" name="name" id= "name" class="form-control font-ubuntu" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
            <input type="text" name="cake_name" id="cake-name" class="form-control font-ubuntu" placeholder="Name to be written on the cake " required>
            </div>
             <div class="form-group">
            <input type="email" name="email" id= "email-address" class="form-control font-ubuntu" placeholder="Enter E-mail" required>
            </div>
            <div class="form-group">
            <p class="font-ubuntu">Booking Date:<input type="text" id="datepicker" class="form-control font-ubuntu" name="date"></p>
            </div>
            <div class="form-group">
            <input type="tel" name="phone" id="phone" class="form-control font-ubuntu" placeholder="Enter Phone number" required>
            </div>
            <div class="form-group">
                <textarea name="addresss" id="addresss" class="form-control font-ubuntu" cols="10" rows="3" placeholder="Enter Delivery Address Here........" required></textarea>
            </div>
          <h6 class="text-center lead">Delivery mode</h6>
            <div class="form-group">
            <select name="Delivery_method" id="Delivery_method" class="form-control">
              <option value="" selected disabled>-Select Delivery Mode-</option>
              <option value="CallForDelivery" id="CallForDelivery" >Call or Message @ <a href="https://wa.link/6z6ul7">+2348023703404</a></option>
              <option value="Pickup" id="Pickup" >Pickup</option>
            </select>
          </div>
          <div class="form-group font-ubuntu">
    <input  id="amount" hidden type="hidden" class="form-control" required value="<?=  ($grand_total)?>" />
  </div>
  <div class="form-submit font-ubuntu">
            <center> <button type="submit" name="submit" class="btn btn-dark" onclick="payWithPaystack()"> Pay </button></center>
        </div>
                </form>
        </div>
        </div>
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

  * {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}
.bg{
 background-color:  rgb(238, 217, 221);
}
/* Float four columns side by side */
/* Float four columns side by side */
.flirt {
  float: left;
  width: 25%;
  padding: 0 20px;
}
.avatars {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
/* Remove extra left and right margins, due to padding */

.row2 {
  margin-left: 120px;
padding: 10px;
}

/* Clear floats after the columns */

/* Clear floats after the columns */
.row2:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */

/* Responsive columns */
           @media screen and (max-width: 600px) {
  .row2{
    margin-left: 0;
  }
  .row1{
    margin-left: 0;
  }
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
/* Responsive columns */
/* @media screen and (max-width: 600px) {
  .flirt {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
} */

/* Style the counter cards */

   .cod{
  background-color: rgb(238, 217, 221);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2) ;
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
    font-size: 30px;
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
      background-color: pink;
      height: auto;
      font-family: Arial, Helvetica, sans-serif;
      text-align: center;
      font-size: 16px;
      color: black;

    }
    .m{
      margin: 30px;
      margin-top: 0px;
    }
</style>
<div class="footer fine ">
            <div class="container">
                <div class="row">
                  <div class="footer-links fifty">
                <h3 class="font-paris">Shops</h3>   

                <div class="font-ubuntu " >
     <li> <a class="" style="color: white;" href="grab.php" >Grab & Go </a></li>
     <br>
   <li>  <a class="" style="color: white;"  href="#">Fondant Cakes</a></li>
   <br>

    <li><a class=" text-capitalize" style="color: white;"  href="#" >Wedding cakes</a></li>
    <br>

    <li><a class=" text-capitalize" style="color: white;"  href="#">   dessert cakes</a></li>
    <br>

    </div>   
                  </div>
                  <div class="footer-about fifty">
              <h3 class="font-paris">About Us</h3>

              <p class="">Nuts About Cakes is a full service bakery that consistently delivers superior quality in cakes, pastries, bread and desserts. We have been in the business of delighting taste buds for over 10 years.</p>   
              <p>Head Branch: 33 Fola Osibo Street, Lekki Phase 1. Lagos. Nigeria.See All Our Branches</p>  
                  </div>
                  <div class=" well">
		<div class=""></div>
    <div id="" class="m" >
      <div class="font-ubuntu m-0 " style="color: white;">
      <h3 class="">For FeedBack:</h3>
      </div>
			<form method="post"  action="" class="footer-about " >
				<div class="form-group">
					<h3>Your Email:</h3>
					<input type="email" class="form-control font-ubuntu" name="emails" required="required"/>
				</div>
			  <div class="form-group">
        <h3>Message Us</h3>
                <textarea required name="address" class="form-control font-ubuntu" cols="5" rows="3" placeholder="Enter Message Here........"></textarea>
            </div>
            <div class="form-group">
			<center><button type="submit" name="send" class="btn btn-primary"> <i class="fas fa-mail-bulk"></i>Send</button></center>
            </div>
			</form>
			<br />
	</div>
	</div>
                  <div class="footer-contact fifty">
              <h3 class="font-paris">Contact Us</h3>
            <p class="font-serious">Click to: (<a href="tel:08023703404" style="color: white;" class="font-serious">Call 08023703404</a>)</p>
            <p class="font-serious">Click to: (<a href="mailto:cakegalleries@gmail.com" style="color: white;">Email Us!</a>)</p>
                  </div>
                </div>
            </div>
              </div>
              <footer class="kemi">Copyright 2020 © Cake Galleries. All rights reserved. @Mikini </footer>
        <!-- Footer End -->


<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    const paymentForm = document.getElementById('placeOrder');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_test_46abc4f7370221336bb54bae90cccbde844edf1d', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
    name: document.getElementById("name").value,
    datepicker: document.getElementById("datepicker").value,
    phone: document.getElementById("phone").value,
    addresss: document.getElementById("addresss").value,
    Delivery: document.getElementById("Delivery_method").value,
   


    ref: 'CK'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
     window.location= "http://localhost/shop/checkout.php?transaction=cancel";
     alert('Transaction cancelled');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/shop/verify_transaction.php?reference=" + response.reference;

    }
  });
  handler.openIframe();
}
</script>
<?php
include 'footter.php';
?>
</body>
</html>
