<?php 
    include('config/constants.php');

    $order_reason = $_POST['order_reason'];
    $order_address = $_POST['order_address'];
    $order_details = $_POST['order_details'];
    $userID = $_POST['userID'];
    $now = date("Y-m-d h:i:sa");
    $res2 = mysqli_query($conn, "INSERT INTO order_table SET  
    userID = $userID,
    order_date='$now',
    order_type= 1,
    order_reason='$order_reason',
    order_details='$order_details',
    order_address='$order_address'
    ");

    $last_id = $conn->insert_id;
    $new_quantity = 0;
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    foreach($id as $key => $val){
        $res = mysqli_query($conn,"SELECT * FROM item WHERE id = '$val'");
        while($row = $res->fetch_assoc()) {
            $new_quantity = $row["quantity"] + $quantity[$key];
        }
        $res3 = mysqli_query($conn, "INSERT INTO order_items SET item_id ='$val', quantity='$quantity[$key]', order_id='$last_id'");
        $res4 = mysqli_query($conn, "UPDATE item SET quantity= $new_quantity WHERE id = $val");
    }
    if(isset($_COOKIE["cart"])) {
        $cookie_data = stripslashes($_COOKIE["cart"]);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $key => $value){
            echo $value["item_id"]."  ". $value["item_name"];
            unset($cart_data[$key]);
            $item_data = json_encode($cart_data);
            setcookie("cart", $item_data, time() +(86400 * 30),"/","localhost",true,);
        }
    }
    header('location:'.SITE_URL.'order.php');
?>