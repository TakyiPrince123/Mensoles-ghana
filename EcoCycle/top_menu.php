<?php session_start();


// // Assuming you have stored the user's email in the session
// $userEmail = $_SESSION['email'];
// $firstLetter = strtoupper(substr($userEmail, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"
    ></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <title>EcoCycle</title>
  </head>

  
  <body>
    <nav>
      <div>
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="#service">Services</a></li>
          <li><a href="Blog.php">Blog</a></li>
        </ul>
      </div>

      <h1>EcoCycle</h1>

      <div>
        <ul>
          <li><a href="#about">About</a></li>
          <li><a href="Contact.html">Contact</a></li>
          <?php if(isset($_SESSION['email'])){?>
          

      <li><a href="logout.php">Logout</a></li>
     
   

  </div>
  </div>
 

</li>
</ul>
          </div>
              


             <div><?=$_SESSION['name']?></div>
           
             <?php }else{?>
                <a href="login.php">👤</a>
             <div><? $_SESSION['email']?></div>
             
         
          <?php }?>
             
        </ul>
      </div>
      <a href="#strokes" class="strokes"> <i class="fa-solid fa-bars"></i></a>
    </nav>

    <div class="lightbox" id="strokes">
      <a href="#" class="Close"><i class="fa-solid fa-xmark"></i></a>

      <div class="lightbox-content">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#service">Services</a></li>
          <li><a href="Blog.html">Blog</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="Contact.html">Contact</a></li>
             <?php if(isset($_SESSION['email'])){?>
      
      <li><a href="logout.php">Logout</a></li>
           <div><?=$_SESSION['name']?></div>
            <?php }else{?>
           
          <a href="login.php">👤</a>
             <div><? $_SESSION['email']?></div>
             
         
          <?php }?>
         
        </ul>
      </div>
    </div>