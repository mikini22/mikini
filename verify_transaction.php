<?php
$ref = $_GET['reference'];
if ($ref == "") {
    # code...
  header("location:javascript://history.go(-1)");
}
?>
<?php
//do not forget to put it in verify transactions.php so that it would send an email if someone pays
  if (isset($_POST['submit'])) {
	  $name = $_POST['name'];
    $email = $_POST['email'];
	  $phone = $_POST['phone'];
    $address = $_POST['addresss'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
    $cake_name =  $_POST['cake_name'];
    $date =  $_POST['date'];
    $Delivery =  $_POST['Delivery_method'];

	  $stmt = $con->prepare('INSERT INTO orders (name,email,phone,addresss,products,amount_paid , cake_name, date, Delivery_method)VALUES(?,?,?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssssss',$name,$email,$phone,$address,$products,$grand_total, $cake_name, $date, $Delivery);
	  $stmt->execute();

    if (!$stmt) {
      echo "There was a problem on your code" . mysqli_error($con);
  }else {
      header("location:success.php?success");
     exit;
  }
  $stmt->close();
  $con->close();

}
else {
 header("location:error.php?error");
exit;

  }
 
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurldecode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_live_5d08bc7d6623597b72dc535f479e20504134142f",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
   echo $response;
  }
 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

   
  if(isset($_POST['submit']) ){
   
    $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
    $address = $_POST['addresss'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
    $cake_name =  $_POST['cake_name'];
    $date =  $_POST['date'];
    $Delivery =  $_POST['Delivery_method'];
    

    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';
      $mail = new PHPMailer(true);                            
      try {
 
          //Server settings
          $mail->isSMTP();                                     
          $mail->Host = 'smtp.gmail.com';                      
          $mail->SMTPAuth = true;                             
          $mail->Username = 'mikinimikizy2002@gmail.com';     
          $mail->Password = 'mikinimikizy';             
          $mail->SMTPOptions = array(
              'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
              )
          );                         
          $mail->SMTPSecure = 'ssl';                           
          $mail->Port = 465;                                   
   
          //Send Email
          $mail->setFrom('mikinimikizy2002@gmail.com');
   
          //Recipients
          $mail->addAddress("mikinimikizy2002@gmail.com");              
          $mail->addReplyTo('mikinimikizy2002@gmail.com');
   
          //Content
          $mail->isHTML(true);                                  
          $mail->Subject = "Order from : " .$name."!!!!!!!!!!";
          $mail->Body    = "$name , $email  , Cake(Quantity): $products , Amount: $grand_total , Address: $address ,  Name on the cake:  $cake_name , $date , Delivery Method: $Delivery .";
   
          $mail->send();
   
        
         
      } catch (Exception $e) {
       $_SESSION['result'] = 'Order could not be sent. Mailer Error: '.$mail->ErrorInfo;
       $_SESSION['status'] = 'error';
      }
   
      $mails = new PHPMailer(true);                            
      try {
 
          //Server settings
          $mails->isSMTP();                                     
          $mails->Host = 'smtp.gmail.com';                      
          $mails->SMTPAuth = true;                             
          $mails->Username = 'mikinimikizy2002@gmail.com';     
          $mails->Password = 'mikinimikizy';             
          $mails->SMTPOptions = array(
              'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
              )
          );                         
          $mails->SMTPSecure = 'ssl';                           
          $mails->Port = 465;                                   
   
          //Send Email
          $mails->setFrom('mikinimikizy2002@gmail.com');
   
          //Recipients
          $mails->addAddress("$email");              
          $mails->addReplyTo('mikinimikizy2002@gmail.com');
   
          //Content
          $mails->isHTML(true);                                  
          $mails->Subject = "Your Order From Cakes Gallery !!!!!!!!!!";
          $mails->Body    = "$name : Dear valued customer, your order is being processed please if you having problem paying please Call or Message @+2348023703404 , Amount : $grand_total";
   
          $mails->send();
   
         $_SESSION['result'] =  '<div class="text-center">
         <h1 class="display-4 mt-2 text-danger font-paris">Order Succesfull</h1>
       </div>';
       echo $data;
       $_SESSION['status'] = 'ok';
      } catch (Exception $e) {
       $_SESSION['result'] = 'Order could not be sent. Mailer Error: '.$mails->ErrorInfo;
       $_SESSION['status'] = 'error';
      }
      
}
?>