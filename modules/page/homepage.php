<?php

include_once('../../config/connect.php');

$output = '';

$search = $_POST['search'];

$sql = "SELECT * FROM item WHERE name LIKE '%$search%' OR sku LIKE '%$search%' OR supplier LIKE '%$search%' ORDER BY name ASC LIMIT 10";


//Execute the query
$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count >0)
{
    $output .= '<table class="table"><thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Warehouse Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';
    while($row=mysqli_fetch_assoc($res))
    {
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

        $output .= '<tr>
                    <th scope="row">'.$id.'</th>
                    <td>'.$item_name.'</td>
                    <td>'.$sku.'</td>
                    <td>'.$quantity.'</td>
                    <td>'.$warehouse_name.'</td>
                    <td>'.$product_name.'</td>
                    <td>'.$supplier.'</td>
                    <td>
                        <form>
                            <a type="button" class="btn btn-primary" href="../edit/edit-item-home.php?id='.$id.'">Edit Item</a>
                        </form>
                    </td>
                </tr>';
    }
    // UNCOMMENT THIS IF YOU WANT TO HAVE PAGE FRAGMENT 
    // $output .='</tbody></table><ul id="PageFragment"><li class="btn btn-primary active" onclick="changePage(1)">1</li>';
    // for($i = 2; $i <= ceil($count / 10) && $i <= 6;$i++){
    //     $output .= '<li class="btn btn-primary" onclick="changePage('.$i.')">'.$i.'</li>';
    // }
    // $output .='</ul>';
    $output .='</tbody></table>';
}
else
{
    $output .='<strong>No Item Available</strong>';
}

echo $output;

?>