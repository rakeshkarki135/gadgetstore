<?php 

include("config.php");

if(isset($_POST["pid"])){
     $pid = $_POST["pid"];
     $pname = $_POST["pname"];
     $pprice = $_POST["pprice"];
     $pimage = $_POST["pimage"];
     $pcode = $_POST["pcode"];
     $pqty = 1;

     // check whether product exist in cart or not
     $stmt = $conn->prepare("SELECT product_code FROM cart WHERE product_code=?");
     // pass the variable $pcode not value
     $stmt->bind_param("s",$pcode);
     $stmt->execute();
     $res = $stmt->get_result();
     if($res->num_rows >0){
          $r = $res->fetch_assoc();
          $code = $r['product_code'];
     }else{
          $code = null;
     }
     

     if(!$code){
          $query = $conn->prepare("INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)");

          $query->bind_param("sssiss",$pname,$pprice,$pimage,$pqty,$pprice,$pcode);

          $query->execute();

          echo 'Item added to your cart';


     }else{
          echo 'Item alerady added to your cart';

     }
}

//check the parameter cartItem and its value cart_item sent from get request if they exist or not
if(isset($_GET['cartItem']) && isset($_GET['cartItem'])=='cart_item'){
     $stmt = $conn->prepare("SELECT * FROM cart");
     $stmt->execute();
     $stmt->store_result();
     $rows = $stmt->num_rows;

     echo '('.$rows.')';

}
?>