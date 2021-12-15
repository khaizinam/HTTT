<?php

include('../../assets/inc/header.php');

$output = '';

$search = $_POST['search'];

$sql = "SELECT * FROM order_table WHERE id LIKE '%$search%' OR order_type LIKE '%$search%' OR order_reason LIKE '%$search%' OR order_details LIKE '%$search%' OR order_address LIKE '%$search%' ORDER BY id DESC LIMIT 10";

//Execute the query
$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count >0)
{
    $output .= '<table class="table"><thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order Type</th>
                    <th scope="col">Order Reason</th>
                    <th scope="col">Order Details</th>
                    <th scope="col">Order Address</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';
    while($row=mysqli_fetch_assoc($res))
    {
        $order_id = $row['id'];
        $order_type = $row['order_type'];
        $order_reason = $row['order_reason'];
        $order_details = $row['order_details'];
        $order_address = $row['order_address'];
        $order_date = $row['order_date'];

        $output .= '<tr>
                    <th scope="row">'.$order_id.'</th>
                    <td>';
        if($order_type == 1)
        {
            $output.="Đơn nhập kho";
        }
        else
        {
            $output.="Đơn xuất kho";
        }
        $output.='</td>
                    <td>'.$order_reason.'</td>
                    <td>'.$order_details.'</td>
                    <td>'.$order_address.'</td>
                    <td>'.$order_date.'</td>
                    <td>
                        <a type="button" class="btn btn-primary" href="../show/show-order.php?id='.$order_id.'">Details</a>
                    </td>
                </tr>';
    }
    $output .='</tbody></table>';
}

echo $output;

?>