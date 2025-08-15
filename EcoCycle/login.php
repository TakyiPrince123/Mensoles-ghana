<?php
session_start();


$conn = new mysqli("localhost", "root", "", "ecocycle");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email and password
    if (empty($email) || empty($password)) {
       echo " <script> alert('Please fill in both fields')</script>";
    }

    $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ? ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
 $row =$result->fetch_assoc();
 $hash_pass =$row['password'];

 if(password_verify($password,$hash_pass)){
  $_SESSION['name'] =$row['name'];
    $_SESSION['email'] =$row['email'];
   header("Location: index.php");
  
 }
 else{
   $password_message="<p style='color: red;text-align: left;'>Incorrect Password</p>";
 
 }
    } else {
      //  $error_message1="<p style='color: red;text-align: center;'>Some error occured</p>";
         $email_error="<p style='color: red;text-align: left;'>Email not found</p>";

    }
}










?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
      border: 1px solid ;
      height: 70vh;
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
 <form action="login.php" method = "POST">
<h3>Login</h3>
<br><hr>

<div class="box">

  <label for="">Email</label><br>
<input type="text" placeholder="example@email.com" name="email">
<?php if(isset($email_error)) {?>
        <div><?php echo $email_error;?></div>
      <?php }?> 

<label for="">Password</label>
<input type="password"  name="password" id="password">
<?php if(isset($password_message)) {?>
        <div><?php echo $password_message;?></div>
      <?php }?> 
</div>

<a href="ResetPassword.php">Forget Password ?</a>

<button type="submit" name="login">Login</button>


<br><br>
<p>Create an  <a href="register.php">Account</a>.</p>

</form>

  
</body>
</html>