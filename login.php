
<?php

include("config.php");
session_start();


$message = array();
if(isset($_POST['submit'])){

     // escape the special character by mysqli_real_escape_string
     $email = mysqli_real_escape_string($conn, $_POST['username']) ;
     // hashing the password using md5
     $pass = mysqli_real_escape_string($conn, $_POST['password']);

     // fetching data from the query
     $select_user = mysqli_query($conn , "SELECT * FROM `users` WHERE email = '$email'")or die("Query Failed");

     // checking if the query exists or not
     if(mysqli_num_rows($select_user) > 0){

          $row = mysqli_fetch_assoc($select_user);

          if($pass == $row['password']){
               if($row['user_type'] == 'admin'){
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('Location:admin.php');
                    exit();

               }elseif($row['user_type'] == 'user'){
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header('Location:index.php');
                    exit();

               }
     }else{
          $message[] = "Incorrect Password";
     }
}else{
     $message[] = "Email doesnot Exists";
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
               margin-top: 12%;
               background-color: white;

          }

          .inputs{
               padding:0px 0px 30px 30px;
          }

          input{
               width:90%;
               height:30px;
               padding:5px;
               border-radius: 5px;
               font-size: 20px;
               color:rgba(0, 0, 0, 0.623);

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
               text-align:center;
          }
     </style>
</head>
<body>
     <div class="container">
          <div class="form-container">
               <?php 
               
               if(!empty($message)){
                    foreach($message as $msg){
                         echo '<div class="message">'.$msg.'</div>';
                    }
               }
               ?>
               <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputs">
                         <input type="text" name="username" placeholder="Username">
                    </div>
                    <div class="inputs">
                         <input type="password" name="password" placeholder="Password">
                    </div>
                    <div class="inputs">
                         <button type="submit" name="submit">Login</button>
                    </div>
                    <a href="register.php"><p style="text-align:center;color:red;text-decoration:none;">Don't have an account?Register here.</p></a>
                    
               </form>


          </div>
     </div>
</body>
</html>