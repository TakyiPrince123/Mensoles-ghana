<?php
$conn = new mysqli("localhost", "root", "", "ecocycle");
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
  }



if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $Re_email = $_POST['email'];
    $Re_password = $_POST['new_password'];
     $Re_confirm = $_POST['confirm_password'];

    // Validate email and password
    if (empty($Re_email) || empty($Re_password) || empty($Re_confirm)) {
        echo " <script> alert('Please fill in both fields')</script>";
      
    }else{

     $Query = $conn->prepare("SELECT * FROM registration WHERE email = ? ");
    $Query->bind_param("s", $Re_email);
    $Query->execute();
    $result = $Query->get_result();

     if ($result->num_rows > 0) {
      //new password
      if( $Re_password == $Re_confirm){
        $hide_password=password_hash($Re_password,PASSWORD_DEFAULT);

        //update password
 $UpdateQuery = $conn->prepare("UPDATE registration SET password= ? WHERE email= ?");
    $UpdateQuery->bind_param("ss",$hide_password,$Re_email);
    $UpdateQuery->execute();
    $result = $UpdateQuery->get_result();

     header("Location: login.php");
    

      }else{
       
        $password_message="<p style='color: red;text-align: left;'> New password and confirm password do no match</p>";
      }
     }else{
         $email_error="<p style='color: red;text-align: left;'>Email not found</p>";
     }
    }




  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

        html{
      background-color: #f1f3f7;
    }


      form h3{
    
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      opacity: 0.5;
      text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.9);
      letter-spacing: 3px;
    }
    form{
      width: 50vw;
      border: 1px solid;
      height: 60vh;
      margin: 10vh  auto;
      text-align: center;
      padding: 0px 30px;
      border-bottom-left-radius: 20px;
         border-bottom-right-radius: 20px;
         border-top: 6px solid #a0b7ec;
         display: flex;
         flex-direction: column;
         gap: 8px;
    }

    form .box{
      display: grid;
      text-align: left;
    }

    form input{
      font-size: 1.4em;
     border: none;
       box-shadow: 0px 0px 1px #a0b7ec;
       padding: 5px;
   
    }

    form button{
      font-size: 1.5em;
      background-color: #a0b7ec;
      border: none;
      color: white;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.9);
    }


      @media only screen and (max-width: 480px){


          form h3{
      font-size: 2.5em;
       letter-spacing: 0px;
       opacity: 1;
    }

      form{
        width: 90%;
        gap: 20px;
        height: 100%;
        border-right: none;
           border-left: none;
              border-bottom: none;
       
      }

         form  input{
  font-size: 2em;
  width: 100%;
  height: 2em;
  border: 1px solid;
  padding: 5px;
}

form label{
  font-size: 2em;
}

form a{
  font-size: 1.5em;
}

  form button{
      font-size: 3em;
     
    }
      }
  </style>
</head>
<body>
  
 <form action="" method = "POST">
<h3>Reset Password</h3>
<br><hr>

<div class="box">

  <label for="">Email</label><br>
<input type="text" placeholder="example@email.com" name="email">
 <?php if(isset($email_error)) {?>
        <div><?php echo $email_error;?></div>
      <?php }?> 

<label for="">New Password</label>
<input type="password"  name="new_password" >

<label for="">Confirm Password</label>
<input type="password"  name="confirm_password" >
 <?php if(isset($password_message)) {?>
        <div><?php echo $password_message;?></div>
      <?php }?> 


</div>



<button type="submit" name="save">SAVE</button>

</form>
  
</body>
</html>