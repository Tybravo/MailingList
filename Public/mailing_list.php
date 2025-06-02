
<?php include("layouts/header.php"); ?>
<?php require_once("../includes/initialize.php"); ?>
<title>Submit Email</title>



<body>
<div id="mainp">
<div id="blockpanel_index" style="overflow: auto; text-align: left; margin-left:42px;">
<br>


<div id="anchordiv"></div><br>
	<h4 style="text-align:center;"><b>SUBMIT YOUR EMAIL FOR UPDATE, SETUPS, AND SIGNALS </b></h4>
<hr>



<?php

$email ="";
$firstname ="";
$lastname ="";

$msg1 ="";
$msg2 ="";
$msg3 ="";


if(isset($_POST['submitemail'])){
$email= $_POST['email'];
$firstname= $_POST['firstname'];
$lastname= $_POST['lastname'];
$created= strftime("%Y-%m-%d %H:%M:%S", time());
$s_day= strftime("%d", time());
$s_month= strftime("%m", time());
$s_year= strftime("%Y", time());
$time_current = date("g.ia");

$setups= 1;
$verify_string= "";
for($i=0;$i<18; $i++){
$verify_string .=chr(mt_rand(48,57));
}


//CHECK FIELDS IF EMPTY OR NOT SELECTED
if($email==""){
$msg1= "<font color= 'red'><br>Email field cannot be empty.</font>";
}
if($firstname==""){
$msg2= "<font color= 'red'><br>Firstname field cannot be empty.</font>";
}

$newuser=List_mailing::find_by_newuser_email($email);
if(!empty($newuser)){
$user_email=$newuser->email;
if(strcasecmp($user_email, $email) == 0){
//if($user_email == $email){

echo"<h2 style='color: #d200a1; 
text-align: center; 
margin-top: 0px;
padding: 6px 32px; 
border: 1px solid #d200a1;
font-size: 16px;
display: absolute;
background: url(images/error.png) #feddfd no-repeat left 5px;'>Email already submitted.</h2>";
}
}

if(empty($newuser) && ($email !="") && ($firstname !="")){





      ///*****Initiate Mailer*****///

//SEND NOTIFICATION TO INVESTOR AFTER REGISTRATION
$useremail=$email;
$topic_msg='We Recieved Your Email! ';
$icon_msg="<img src='https://revenueabode.com/images/revabode_logo01_white.png' width='180' height='46';/>";

$body_msg='Dear '.$firstname.',
You are welcome to Revenue Abode Forex (RAF) learning and earning. We received your email address for updates and setups. If you are not yet a member of RAF, you should register now and become a lifetime gold member. Our promo package is still on. '.$firstname.', we are looking forward to see you at the top.

<br>
Do not reply to this email. you can visit our website on https://revenueabode.com and contact us through our email for any support. Thanks.

<br><br>
Team Management.
';


//MESSAGE CONTENT STARTS HERE
$content_msg='
<html>
<head>
<title></title>
</head>
<body>

<table style="-moz-box-shadow:inset 0px 1px 0px 0px #ffffff; -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff; box-shadow:inset 0px 1px 0px 0px #ffffff; background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6)); background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%); background-color:#ffffff; color:#333333; border:1px solid #dcdcdc; margin-left: 10px; margin-right: 200px; padding-left:2px; padding-right:2px; width:90%;">
<tr style="-moz-box-shadow:inset 0px 1px 0px 0px #54a3f7; -webkit-box-shadow:inset 0px 1px 0px 0px #54a3f7; box-shadow:inset 0px 1px 0px 0px #54a3f7; background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #007dc1), color-stop(1, #0061a7)); background:-moz-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-webkit-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-o-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-ms-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%); background-color:#007dc1;border:1px solid #124d77; cursor:pointer; color:#FFAA54; font-family:arial; font-size:28px; font-weight:bold; text-decoration:none; text-align:center; text-shadow:0px 1px 0px #154682; padding-top:10px; padding-bottom:5px; height:50px;">
<td><span style="margin-left:20px; text-align:center;">'.$icon_msg.'</span></td>
</tr>
<tr>
<td style="background-color:#f9f9f9; padding-top: 30px; padding-bottom: 30px; border:none; border-top:1px solid #dcdcdc; border-bottom:1px solid #dcdcdc; font-family:arial; text-align:center; color: #FFAA54; font-size:24px;">'.$topic_msg.'</td>
</tr>
<tr>
<td style="background-color:#f9f9f9; padding-top: 30px; padding-bottom: 30px; border:none; border-top:1px solid #dcdcdc; border-bottom:1px solid #dcdcdc; text-align:left; color: #555555; font-size:16px;">'.$body_msg.'</td>
</tr>
<tr>
<td style="text-align:left; font-size:15px; color:#A6A6A6;">'.$loginpage_msg.'</b></td>
</tr>
<tr>
<td style="background-color:#72a7ed; padding-top: 10px; padding-bottom: 10px; padding-left: 30px; padding-right: 30px; border:none; border-top:1px solid #dcdcdc; border-bottom:1px solid #dcdcdc; text-align:center;"><div style="color:#FFFFFF; font-size:12px; line-height:1.3em;">Skygital Hangout is a trademark of Revenue Abode. Located at Hq 98 Logan street, Nottingham, United Kingdom. Copyright &copy; '.$s_year.' by
Revenue Abode. All rights reserved.</div><div style="color:#FFAA54; font-size:12px;">Thank you for using Revenue Abode!</div></td>
</tr>
</table>

</body>
</html>'; 
//MESSAGE CONTENT STOPS HERE


//TO SEND MESSAGE TO EMAIL USING PHPMAILER
require 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'server161.web-hosting.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
 

$mail->Username = "enteryouremail";
$mail->Password = "enteryourpassword";
 
$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
 
$mail->From = "noreply@revenueabode.com";
$mail->FromName = "Revenue Abode";
 $mail->addAddress($useremail);
 
$mail->Subject = 'Email Received';
$mail->Body = $content_msg;

if($mail->Send()){
$useremail=$email;

}

else{echo" Connection Failed"; }

}


if(empty($newuser) && !empty($email) && !empty($firstname)){

  //process insert into database
$sql= "INSERT INTO list_mailing (email,firstname,lastname,setups,verify_string,created,s_day,s_month,s_year,time_current) VALUES (";
$sql .= " '".$email."',";
$sql .= " '".$firstname."',";
$sql .= " '".$lastname."',";
$sql .= " '".$setups."',";
$sql .= " '".$verify_string."',";
$sql .= " '".$created."',";
$sql .= " '".$s_day."',";
$sql .= " '".$s_month."',";
$sql .= " '".$s_year."',";
$sql .= " '".$time_current."')";
$sqlresult= mysql_query($sql);
if($sqlresult){

echo"<h2 style='color: #00d2a1; 
text-align: center; 
margin-top: 0px;
padding: 6px 32px; 
border: 1px solid #00d2a1; 
font-size: 18px; 
background: url(images/checkout.png) #ddfefd no-repeat left 5px;'>Submitted Successfully</h2>";

}
}

}
?>



<form action="mailing_list.php" enctype="multipart/form-data" method="POST">

 <table class= "bordered" style="overflow: auto;">

<tr>
<td><?php if($email==""){
echo "$msg1";
} ?><br>Email Address:</td><td><input type= "text" name= "email" /></td></tr>

<tr>
<td><?php if($firstname==""){
echo "$msg2";
} ?><br>First Name:</td><td><input type= "text" name= "firstname" /></td></tr>

<tr>
<td>Last Name:</td><td><input type= "text" name= "lastname" /></td></tr>

</table>

<br>
<input type= "submit" name= "submitemail" value= "Submit"/>
&#160;&#160;
<a href="packages_promo_one.php"><img src="images/Raf_promo_logo01.png" style="margin:15px;" title="Raf Promo logo";/></a>
</form>



</div>
</div>


</body>




<?php require_once("layouts/footer.php"); ?>
