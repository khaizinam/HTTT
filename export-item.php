<?php
include_once('config/constants.php');

$id = $_GET['id'];

$output = '';

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
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $warehouse_id = $row['warehouse_id'];

    $sql2 = "SELECT name from warehouse WHERE id = $warehouse_id";

    $res2 = mysqli_query($conn, $sql2);
    
    $row2 = mysqli_fetch_assoc($res2);

    $warehouse_name = $row2['name'];

    $sql3 = "SELECT name from product WHERE id = $product_id";

    $res3 = mysqli_query($conn, $sql3);
    
    $row3 = mysqli_fetch_assoc($res3);

    $product_name = $row3['name'];


    $output .= '<tr class="itemCartremove'.$id.' prop">
    <td>'.$item_name.'</td>
    <td>'.$sku.'</td>
    <td>
        <div class="input-group" style="width:150px; flex-wrap: nowrap;">
            <div class="input-group-prepend" style="cursor:pointer" onclick="decTotal(this)">
                <span class="input-group-text">-</span>
            </div>
            <input type="hidden" name="in_stock" class="in_stock" value="'.$quantity.'">
            <input type="number" class="form-control quantity-item" value="1" name="quantity[]" onchange="input_change(this)">
                <form class="quantityForm">
                    <input class="item_id" type="hidden" value="'.$id.'" name="id">
                </form>
            <div class="input-group-append" style="cursor:pointer" onclick="incTotal(this)">
                <span class="input-group-text">+</span>
            </div>
        </div>
    </td>
    <td>'.$warehouse_name.'</td>
    <td>'.$product_name.'</td>
    <td>'.$supplier.'</td>
    <td>
        <form class="remove'.$id.'Form">
        <input type="hidden" value="'.$id.'" name="id-remove">
        <button type="button" class="btn btn-danger" id="remove'.$id.'" onclick="removeCart(this.id)" name="removeBtn">Delete Item</button>
        </form>
    </td>
    </tr>';
}
echo $output;
?>