<?php
    $id = $_POST['id'];
    if(isset($_COOKIE["cart"])) {
        $cookie_data = stripslashes($_COOKIE["cart"]);
        $cart_data = json_decode($cookie_data, true);
        $new;
        foreach($cart_data as $key => $value){
            echo $value["item_id"]."  ". $value["item_name"];
            if($value["item_id"] == $id){
                $cart_data[$key]["item_quantity"]++;
            }
        }
        $item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
        setcookie("cart", $item_data, time() +(86400 * 30),"/","localhost",true,);
    }
?>