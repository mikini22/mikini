<?php
  //header php
  session_start();
  include ('header.php');
  include "helper.php";

  
?>
<?php 
    require ('mysqlconnect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require "login-process.php";
}
 
?>

<!--login area-->
<section id="login">
  <style>
    #login {
    padding: 5% 0;
    background: url("assets/background.png") no-repeat;
    background-size: cover;
}
#log-form input[type='email'],
#log-form input[type='password']{
    border: none;
    border-radius: unset;
    border-bottom: 1px solid var(--color-border);
    font-family: var(--font-ubuntu);
}
 

#log-form input[type='email'],
#log-form input[type='password']{
    outline: none;
    box-shadow: none;
}
  </style>
    <!-- registration area -->
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">Create a new <a href="register.php">account</a></span>
            </div>
            <div class="d-flex justify-content-center">
                <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="email" required name="email" id="email" class="form-control" placeholder="Email*">
                        </div>
                    </div>

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="password" id="password" class="form-control" placeholder="password*">
                        </div>
                    </div>

                    <div class="submit-btn text-center my-5">
                        <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<!--#login area-->
<?php
//footer php
include ('footer.php');
?>


