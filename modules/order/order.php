<?php include('../../assets/inc/header.php'); ?>
<?php 
    if(isset($_SESSION['create-order']))
    {
        unset($_SESSION['create-order']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Create Order Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_SESSION['create-order-failed']))
    {
        unset($_SESSION['create-order-failed']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Create Order Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
?>
    <div class="container-fluid">
        <h3 class='text-center'>Export/Import Order</h3>
    </div>
    <div class="container-xl product">
        <div class='w-100'>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search For Order..." id='keyword' autocomplete="off">
                <div class="input-group-append">
                    <span class="input-group-text" id='search-bar' style='cursor: pointer; height: 100%;'>
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class='table-responsive-xl'>
            <table class="table" id ="result">

            </table>
        </div>
    </div>
    <div class="container-xl border" style="margin-top: 10px;">
        <h4>Order</h4>
        <button class="btn btn-secondary" style="float: right;"><a href="../export/export.php" class="text-decoration-none text-white"><i class="fa fa-minus-circle" style="font-size: 23px; padding-right: 5px;"></i>Export Item</a></button>
        <button class="btn btn-success" ><a href="../import/import.php" class="text-decoration-none text-white"><i class="fa fa-plus-circle" style="font-size: 23px; padding-right: 5px;"></i>Import Item</a></button>
        <div class='table-responsive-xl' id="result2">
            <table class="table">
                <thead>
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
                <tbody>
                    <?php
                        $sql = "SELECT * FROM order_table ORDER BY id DESC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $order_id = $row['id'];
                                $order_type = $row['order_type'];
                                $order_reason = $row['order_reason'];
                                $order_details = $row['order_details'];
                                $order_address = $row['order_address'];
                                $order_date = $row['order_date'];
                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $order_id; ?></th>
                                    <td>
                                        <?php
                                            if($order_type == 1)
                                            {
                                                echo "????n nh???p kho";
                                            }
                                            else
                                            {
                                                echo "????n xu???t kho";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $order_reason; ?></td>
                                    <td><?php echo $order_details; ?></td>
                                    <td><?php echo $order_address; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <a type="button" class="btn btn-primary" href="../show/show-order.php?id=<?php echo $order_id; ?>">Details</a>
                                    </td>
                                </tr>
                                <?php
                            }

                                
                        }
                    ?>
                </tbody>
            </table>
            <ul id="PageFragment">
                    <?php
                    if(ceil($count / 10) >= 2)
                    {
                        echo "<li class='btn btn-primary active' onclick='changePage(1)'>1</li>";
                    for($i = 2; $i <= ceil($count / 10) && $i <= 6;$i++){
                        echo "<li class='btn btn-primary' onclick='changePage(".$i.")'>".$i."</li>";
                    }
                    }
                    ?>
            </ul>
        </div>
    </div>

<script src="../../assets/js/fragment.js"></script>
<script src="../../assets/js/search.js"></script>
<?php include('../../assets/inc/footer.php'); ?>