<?php 

include_once('config/constants.php');
$id = $_GET['id'];
$quantity = $_GET['quantity'];

if(isset($_COOKIE["cart-exported"])) {
    $cookie_data = stripslashes($_COOKIE["cart-exported"]);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $key => $value){
        echo $value["item_id"]."  ". $value["item_name"];
        if($value["item_id"] == $id){
            $cart_data[$key]["item_quantity"] = $quantity;
        }
    }
}
$item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
setcookie("cart-exported",$item_data, time() + (86400 * 30),"/","localhost",true,);
?>