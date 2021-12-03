<?php 

include_once('config/constants.php');
$flag = 0;
$id = $_GET['id'];
$sql = "SELECT * FROM item WHERE id = $id";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count == 1)
{
    $row = mysqli_fetch_assoc($res);
    $id = $row['id'];
    $item_name = $row['name'];
    $sku = $row['sku'];
    $supplier = $row['supplier'];
    $quantity = $row['quantity'];
    $product_id = $row['product_id'];
    $warehouse_id = $row['warehouse_id'];

    $sql2 = "SELECT name from warehouse WHERE id = $warehouse_id";

    $res2 = mysqli_query($conn, $sql2);
    
    $row2 = mysqli_fetch_assoc($res2);

    $warehouse_name = $row2['name'];

    $sql3 = "SELECT name from product WHERE id = $product_id";

    $res3 = mysqli_query($conn, $sql3);
    
    $row3 = mysqli_fetch_assoc($res3);

    $product_name = $row3['name'];

    if(isset($_COOKIE["cart-exported"])) {
        $cookie_data = stripslashes($_COOKIE["cart-exported"]);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $key => $value){
            echo $value["item_id"]."  ". $value["item_name"];
            if($value["item_id"] == $id){
                $cart_data[$key]["item_quantity"]++;
                $flag = 1;
            }
        }
    }
    if($flag==0)
    {
        $item_array = array(
            'item_id' => $id,
            'item_name' => $item_name,
            'sku' => $sku,
            'item_quantity' => '1',
            'supplier' => $supplier,
            'quantity' => $quantity,
            'product_id' => $product_id,
            'warehouse_id' => $warehouse_id
        );
        $cart_data[] = $item_array;
    }
    $item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
    setcookie("cart-exported",$item_data, time() + (86400 * 30),"/","localhost",true,);
}
?>