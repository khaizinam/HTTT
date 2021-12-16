<?php include('partials/menu.php'); ?>

<div class="container-fluid">
        <h3 class='text-center'>Warehouse</h3>
        <button class="btn btn-success">admin/add-warehouse.php" class="text-decoration-none text-white"><i class="fa fa-plus-circle" style="font-size: 23px; padding-right: 5px;"></i>Add new Warehouse</a></button>
</div>

<div class="container-xl" style="margin-top: 10px;">
    <?php
        if(isset($_SESSION['add-warehouse-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Add warehouse Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-warehouse-success']);
        }

        if(isset($_SESSION['add-warehouse-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Add warehouse!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-warehouse-failed']);
        }

        if(isset($_SESSION['edit-warehouse-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Edit warehouse Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['edit-warehouse-success']);
        }

        if(isset($_SESSION['edit-warehouse-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Edit warehouse!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['edit-warehouse-failed']);
        }

        if(isset($_SESSION['delete-warehouse-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Delete warehouse Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-warehouse-success']);
        }

        if(isset($_SESSION['delete-warehouse-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Delete warehouse!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-warehouse-failed']);
        }
    ?>
        <h4>Warehouse</h4>
        <div class='table-responsive-xl'>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Warehouse Name</th>
                        <th scope="col">Warehouse Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * from warehouse ORDER BY name";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        if($count > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $warehouse_id = $row['id'];
                                $warehouse_name = $row['name'];
                                $warehouse_address = $row['address'];

                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $warehouse_id; ?></th>
                                    <td><?php echo $warehouse_name; ?></td>
                                    <td><?php echo $warehouse_address; ?></td>
                                    <td>
                                        <a href="admin/edit-warehouse.php?id=<?php echo $warehouse_id; ?>" class="btn btn-primary" type="button">Edit Warehouse</a>
                                        <a href="admin/show-warehouse.php?id=<?php echo $warehouse_id; ?>" class="btn btn-secondary" type="button">Inventory Details</a>
                                        <a href="admin/delete-warehouse.php?id=<?php echo $warehouse_id; ?>" class="btn btn-danger" type="button">Delete Warehouse</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "No Warehouse Available";
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
<script src="../public/js/fragment.js"></script>
<?php include('partials/footer.php'); ?>