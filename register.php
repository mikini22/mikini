<?php
  //header php
  include ('header.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   require('register-process.php');
}
?>
<!--registration area-->
<section id="register">
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
         <div class="text-center pb-5">
         <h1 class="login-title text-dark">Register</h1>
         <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
            <span class="font-ubuntu text-black-50">I already have <a href="login.php">Login</a></span>
         </div>
         <div class="d-flex justify-content-center">
         <form method="post" action="register.php" enctype="multipart/form-data" id="reg-form">
         <div class="form-row">
           <div class="col">
             <input type="text" value="<?php if (isset($_POST['firstname']))echo $_POST['firstname']; ?>"  name="firstname" id="firstname" class="form-control" placeholder="First Name"> 
           </div>
           <div class="col my-2">
             <input type="text" value="<?php if (isset($_POST['lastname'])){echo $_POST['lastname']; } ?>" name="lastname" id="lastname" class="form-control" placeholder="Last Name">
           </div>
         </div>
         <div class="form-row my-2">
           <div class="col">
             <input type="email" value="<?php if (isset($_POST['email'])){echo $_POST['email']; } ?>" required name="email" id="email" class="form-control" placeholder="Email*">
           </div>
         </div>
         <div class="form-row my-2">
           <div class="col">
             <input type="password" required name="password" id="password" class="form-control" placeholder="Password*">

           </div>
         </div>
         <div class="form-row my-2">
           <div class="col">
             <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm password*">
             <small id ="confirm_error" ></small>
             
           </div>
         </div>
         <div class="form-check form-check-inline mr-6">
           <input type="checkbox" name="agreement" id="form-check-input" required>
           <label for="agreement" class="form-check font-ubuntu text-black-50">I agree <a href="#">term,conditions and policy</a>(*)</label>
         </div>
         <div class="submit-btn text-center my-5">
           <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
         </div>
         </form>
         </div>
       </div>
    </div>

    </section>
<!--#registration area-->
<?php
 include 'footer.php';
?>



