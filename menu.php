<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Gadget Store</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <style>
          img{
               height:250px;
               width:260px;
               padding:5px;
          }

          .menu-text{
               font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
               text-align: center;
          }

          .p{
               font-size: 17px;
          }

          .btn{
               height:30px;
               width:80%;
               margin-left: 25px;
               background-color: blue;
               color:white;
               padding-bottom: 25px;
               border:3px solid blue;
          }

          .btn:hover{
               background-color: white;
               color:blue;
          }

          .baker a{
               color:black;
               text-decoration: none;
          }

          .baker a:hover{
               color:white;

          }

          .baker a span:hover{
               color:black;
          }
     </style>
</head>
<body> 
     <div id="navbar">  
     <nav>
          <div class="baker"><a href="index.php">Gadget<span>Store</span></a></div>
          <ul calss="menu">
               <li><a href="register.php">SIGN-UP</a></li>
               <li><a href="login.php">LOGIN</a></li>
               <li><a href="cart.php">CART<span id="cart-item"></span></a></li>
          </ul>
     </nav>
     </div>


     <div class="heading-box">
          <h1 class="h1 heading-text">Welcome to our Gadget Store</h1>
          <p class="p heading-text">We have best cameras,watches and other gadgets and accessories.You can find all here.</p>
     </div>

     <!-- for message -->
     <!-- <div class="message">
          
     </div> -->
     
     <!-- for menu items -->
     <div class="menu-container">
     <div class="box">
          <?php
               include("config.php");
               $stmt = $conn->prepare("SELECT * FROM product");
               $stmt->execute();
               $result = $stmt->get_result();
               while($row = $result->fetch_assoc()):
          ?>
          <div class="menu-item">
               <img src="<?= $row['product_image'] ?>">
               <h2 class="menu-text"><?= $row['product_name'] ?></h2>
               <p class="p menu-text">Price:Rs.<?= $row['product_price'] ?></p>

          <form action="" class="form-submit">
               <input type="hidden" class="pid" value="<?= $row['id'] ?>">
               <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
               <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
               <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
               <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
               <button class="btn addItemBtn">Add to Cart</button>
          </form>
          </div>
          <?php endwhile; ?>
     </div>
     </div>

     <div class="footer" style="margin-top:50px;">
          <p>Copyright <i class="fa fa-copyright" style="font-size: 20px;"></i> All Rights Reserved | Contact Us: +977 9812345678</p>
          <p>This site is Developed By Rakesh Karki.</p>
     </div>

     <script>
          //const navbar = document.querySelector('#navbar');
          //let top = navbar.offsetTop;
          //function stickynavbar(){
          //     if(window.scrollY >= top){
          //          navbar.classList.add('sticky');
          //     }else{
          //          navbar.classList.remove('sticky');
          //     }
          //}
          //.addEventListener('scroll', stickynavbar);

          $(document).ready(function(){
               $(".addItemBtn").click(function(e){
                    //prevent page refresh when sending data 
                    e.preventDefault();

                    var $form = $(this).closest(".form-submit");
                    var pid = $form.find(".pid").val();
                    var pname = $form.find(".pname").val();
                    var pprice = $form.find(".pprice").val();
                    var pimage = $form.find(".pimage").val();
                    var pcode = $form.find(".pcode").val();

                    $.ajax({
                         url: 'action.php',
                         method: 'post',
                         data: {pid:pid,pname:pname,pprice:pprice,pimage:pimage,pcode:pcode},
                         success:function(response){
                              // $(".message").html(response);
                              alert(response);
                              load_cart_item_number();
                         }
                    });
               });

               // calling function to load cart item
               load_cart_item_number();
               function load_cart_item_number(){
                    $.ajax({
                         url: 'action.php',
                         method: 'get',
                         data : {cartItem:"cart_item"},
                         success:function(response){
                              $("#cart-item").html(response);
                         }
                    })
               }

          });
     </script>
     
</body>
</html>