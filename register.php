<?php

include('config.php');
session_start();

$message = array();

if(isset($_POST['submit'])){
     $name=trim($_POST['name']);
     $email=trim($_POST['email']);
     $password1=trim($_POST['password1']);
     $password2=trim($_POST['password2']);
     $user_type=trim($_POST['user_type']);

     $check = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email' ");

     if(mysqli_num_rows($check) == 0){
          if ($password1 == $password2){
               $query = mysqli_query($conn , "INSERT INTO users (name,email,password,user_type) VALUES ('$name','$email','$password1','$user_type')") or die(mysqli_error($conn));

               if($query){
                    header("Location:login.php");
               }else{
                    $message[]= "User Registration Failed";
               }
          }else{
               $message[]= "Please check your password";
          }
     }else{
          $message[]= "Email already Exists";
     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style> 
          body {
               margin:0px;
               padding:0px;
               box-sizing: border-box;
               background-color:#cad0dd5c;
               font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
          }

          .form-container{
               margin:auto;
               width:30%;
               border-radius:20px;
               padding:30px;
               margin-top: 10%;
               background-color: white;

          }

          .inputs{
               padding:0px 0px 30px 30px;
          }

          input , select {
               width:90%;
               height:30px;
               padding:5px;
               border-radius: 5px;
               font-size: 20px;
               color:rgba(0, 0, 0, 0.623);

          }

          select{
               width:92%;
               height:38px;
               padding:6px;

          } 

          button {
               padding:10px;
               width:100px;
               border-radius: 5px;
               font-size: 20px;
               color:rgba(0, 0, 0, 0.623);
               
          }

          button:hover{
               background-color: white ;
               
          }

          h2{
               text-align:center;
               padding-bottom:15px;
               font-size:40px;
               color:rgba(0, 0, 0, 0.623);
               
          }

          .message{
               color:red;
               font-size: 20px;
               text-align: center;

          }
     </style>
</head>
<body>
<div class="container">
          <div class="form-container">
               <?php 
               
               if(!empty($message)){
                    foreach($message as $msg){
                         '<div class="message">'.$msg.'</div>';
                    }
               }
               ?>
               <form action="" method="post">
                    <?php 
                    
                    if(!empty($message)){
                         foreach($message as $msg){
                              echo '<div class="message">'.$msg.'</div>';
                         }
                    }
                    ?>
                    <h2>User's Registration</h2>
                    <div class="inputs">
                         <input type="text" name="name" placeholder="Username" required>
                    </div>
                    <div class="inputs">
                         <input type="text" name="email" placeholder="Email" required>
                    </div>
                    <div class="inputs">
                         <input type="password" name="password1" placeholder="Password" required>
                    </div>
                    <div class="inputs">
                         <input type="password" name="password2" placeholder="Confirm Password" required>
                    </div>
                    <div class="inputs">
                         <select name="user_type">
                              <option>Select the user type</option> 
                              <option value="admin">Admin</option>
                              <option value="user">User</option>
                         </select>
                    </div>
                    <div class="inputs">
                         <button type="submit" name="submit">Register</button>
                    </div>
                    
               </form>


          </div>
     </div>
     
</body>
</html>