<?php
    $id = $_POST['id-remove'];
    if(isset($_COOKIE["cart-exported"])) {
        $cookie_data = stripslashes($_COOKIE["cart-exported"]);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $key => $value){
            echo $value["item_id"]."  ". $value["item_name"];
            if($value["item_id"] == $id){
                unset($cart_data[$key]);
                $item_data = json_encode($cart_data);
                setcookie("cart-exported", $item_data, time() +(86400 * 30),"/","localhost",true,);
            }
        }
    }
    
?>