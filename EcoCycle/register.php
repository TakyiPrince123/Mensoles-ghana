<?php
include ('connect.php' );



if(isset($_POST['submit'])){

  if(!isset($_POST['terms'])){
    echo  "<p style='color: red;text-align: center;'>You must agree to our terms and conditions</p>" ;
  }else{




    $checkbox=isset($_POST['term']) ?'YES' :'NO';
  $firstName=$_POST['FirstName'];
  $lastName=$_POST['LastName'];
  $email=$_POST['email'];
  $password=$_POST['Password'];
  $encrypt_password=password_hash($password, PASSWORD_DEFAULT);
  $re_password=$_POST['Re_password'];
  $sex= $_POST['Gender'];
  $region=$_POST['Region'];



    
  if($password ===$re_password){

  


  $check_email = "SELECT * FROM registration WHERE email= '$email'";
  $result = $conn->query($check_email);

  if($result->num_rows > 0){
 $email_error= "<p style='color: red;text-align: left;'>Email Already exist</p>";
  
  }else{
   
    $insertQuery="INSERT INTO registration(firstName, lastName, email, password, sex, region, news) VALUES ('$firstName','$lastName','$email','$encrypt_password','$sex','$region',' $checkbox')";
    if($conn->query($insertQuery) ==TRUE){
      header("Location: login.php");
      exit();

    }else{
      echo "Error: " .$conn_error;
    }
    
  }


}

else{
$password_error="<p style='color: red;text-align: left;'>Password don't match!! Please re-check</p>";
$terms_message="<p style='color: red;text-align: left;'>Make sure you accept our terms and condition</p>";
  
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      html {
        background-color: #f1f3f7;
      }

      form h3 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        opacity: 0.5;
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.9);
        letter-spacing: 3px;
      }
      form {
        width: 50vw;
        border: 1px solid;
        height: 90vh;
        margin: 10vh auto;
        text-align: center;
        padding: 0px 30px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        border-top: 6px solid #a0b7ec;
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      input,
      select {
        font-size: 1em;
      }
      form .regis_first {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        align-items: center;
        justify-content: center;
        gap: 30px;
      }

    

      form .regis_first input {
        width: 95%;
      }

      select {
        opacity: 0.5;
        font-size: 1.2em;
      }

      form .regis_third {
        text-align: left;
      }

      form button {
        font-size: 1.5em;
        background-color: #a0b7ec;
        border: none;
        color: white;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.9);
      }

      @media only screen and (max-width: 480px) {
        form {
          width: 90%;
          gap: 20px;
          height: 100%;
          border-right: none;
          border-left: none;
          border-bottom: none;
        }

        form h3 {
          font-size: 2.5em;
          letter-spacing: 0px;
          opacity: 1;
        }

        input,
        select {
          font-size: 2em;
        }

        form .regis_first {
          grid-template-columns: repeat(1, 1fr);
        }

  
        form .regis_third {
          font-size: 2em;
        }

        input {
          border: 1px solid;
        }
      }
    </style>
  </head>
  <body>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method= "POST">
      <h3>Registration</h3>
      <br />
      <?php if (!empty($exists)) :?>
        <p> <?php echo $exists; ?> </p>
      <?php endif; ?>  
      <div class="regis_first">
        <input type="text" placeholder="First Name" id="FirstName" name="FirstName" value="<?php echo isset($_POST['FirstName'])  ?$_POST['FirstName'] :'';?>" />

        <input type="text" placeholder="Last Name" id="LastName" name="LastName" value="<?php echo isset($_POST['LastName'] )? $_POST['LastName'] : '';?>"/>
      </div>

    
      <input type="Email" placeholder="Email" name="email" id="Email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] :'';?>" required />
      <?php if(isset($email_error)) {?>
        <div><?php echo $email_error;?></div>
      <?php }?>     

      <input type="password" placeholder="Password" id="Password" name="Password" />
      <input type="password" placeholder="Re-type Password" name="Re_password" />\
      <?php if(isset($password_error)) {?>
        <div><?php echo $password_error;?></div>
      <?php }?> 
      <br />

      <select name="Gender" required >
        <option value="" hidden>Select your gender</option>
        <option value="Male" name="Male"> Male</option>
        <option value="Female" name="Female"  >Female</option>
      </select>
    

      <br />

      <select name="Region" placeholder="select" id="Region"  value="<?php echo isset($_POST['Region']) ?$_POST['Region'] :'';?>" required>
        <option value="" hidden class="select">Select your Region</option>
        <option value="Greater Accra">Greater Accra</option>
        <option value="Ashanti">Ashanti</option>
        <option value="Western">Western</option>
        <option value="Eastern">Eastern</option>
        <option value="Central">Central</option>
        <option value="Northern">Northern</option>
        <option value="Upper East">Upper East</option>
        <option value="Upper West">Upper West</option>
        <option value="Volta">Volta</option>
        <option value="Western North">Western North</option>
        <option value="Ahafo">Ahafo</option>
        <option value="Bono">Bono</option>
        <option value="Bono East">Bono East</option>
        <option value="Oti">Oti</option>
        <option value="North East">North East</option>
        <option value="Savannah">Savannah</option>
      </select>
      <br />

      <div class="regis_third">
        <input type="checkbox" name="terms" />
        <label for="">I agree with terms and conditions</label>
 <?php if(isset($terms_message)) {?>
        <div><?php echo $terms_message;?></div>
      <?php }?> 
        <br />

        <input type="checkbox" name="term"/>
        <label for="">I want to recieve the newsletter</label>
      </div>

      <br />

      <button type="submit" name="submit" value="submit" id="submit">Register</button>
      <h6>Already have an account <a href="login.php">Login</a></h6>
    </form>

  </body>
</html>
