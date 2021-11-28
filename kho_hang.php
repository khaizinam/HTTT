<button onclick="location.href='kho_hang.php'">refresh</button>
<?php
    //goi include
    include('config/config.php');
    include('classes/class.php');
    //goi các class


    $kho = new warehouse();
    $product = new product();
    $order_tbl = new phieu_xuat_nhap();

    //goi query
    $query = $kho->show();
    $query_2 = $kho->show();
    $query_5 = $kho->show();
        // goi danh sách các product
        $query_1 = $product->show();
        $query_3 = $product->show();
        //phieu
        $query_4 = $order_tbl->show();
    //ROW QUERY
        //
        $row_4 = $query_4->fetch_assoc();

    //METHOD POST WORK
        //create ware house
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['create_warehouse'])=="Create"){
                $alert_tao_kho = $kho->create_new();
                // header('location:kho_hang.php');
            }
            if(isset($_POST['create_product'])=="Create"){
                $alert_create_product = $product->create_new();
                // header('location:kho_hang.php');
            }
            if(isset($_POST['create_order'])=="Create"){
                $alert_2 = $order_tbl->create_new();
                // header('location:kho_hang.php');
            }
            if(isset($_POST['select'])=="ok"){
                $query_6 = $kho->show_item();
                // header('location:kho_hang.php');
            }
        }
       
    //GET REQUEST WORK    
    if(isset($_GET['order_status'])=='done'){
            $id = $_GET['order_id'];
            $order_tbl->close($id);
    }
    //
    ?> 
            <!-- danh sách kho hàng -->


        <h4>Dánh sách kho hàng<h4>
        <table border="1">
            <tr>
                <td>ID kho</td>
                <td>Tên kho</td>
                <td>Địa chỉ kho</td>
            </tr>
        <?php
        while($rows = $query->fetch_assoc()){?>
            <tr>
                <td><?php echo $rows['ID'];?></td>
                <td><?php echo $rows['ten_kho'];?></td>
                <td><?php echo $rows['adress'];?></td>
            </tr>
        <?php } ?>
        </table>

    <hr>
     <!-- Đăng kí kho hàng -->
    <h4> Đăng kí kho hàng<h4>
            <?php
                if(isset( $alert_tao_kho)){
                    echo  $alert_tao_kho;
                }
            ?>
    <form action="kho_hang.php" method="POST">
            <span>Tên kho hàng</span><br>
            <input type="text" name="warehouse_name" id=""><br>
            <span>địa chỉ kho hàng</span><br>
            <input type="text" name="warehouse_adress" id=""><br>
            <input type="submit" name="create_warehouse" value="Create">    
    </form>
    <hr>

     <!-- các hàng hóa trong kho hàng -->
         <span>kho hàng</span>
        <form action="kho_hang.php" method="POST">
            <select name="kho_hang_ID" id="">
                <?php while($row_5 = $query_5->fetch_assoc()){?>
                    <option value="<?php echo $row_5['ID']?>"><?php echo $row_5['ten_kho']?></option>
                <?php } ?>
            </select>    
            <input type="submit" name="select" value="ok">    
        </form>

         <?php if(isset($query_6)){ 
              $check_num = mysqli_num_rows($query_6);
              if($check_num == 0) {
                  echo 'Kho rỗng';
              }else{
              ?>
        <table border="1">
            <tr>
                <td>ID item</td>
                <td>Tên </td>
                <td>ID product</td>
                <td>Số lượng</td>
            </tr>  
            <?php
            while($rows_6 = $query_6->fetch_assoc()){ 
            ?>
            <tr>
                <td><?php echo $rows_6['ID'];?></td>
                <td><?php echo $rows_6['product_name'];?></td>
                <td><?php echo $rows_6['productID'];?></td>
                <td><?php echo $rows_6['quantity'];?></td>
            </tr>
        <?php } ?>  
        </table>
    <?php }} ?>  
        <hr>

     <h4>Dánh sách hàng hóa đã đăng kí<h4>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>Tên hàng hóa</td>
                <td>Mô tả</td>
                <td>Loại</td>
                <td>ghi chú</td>
            </tr>
        <?php
        while($rows_1 = $query_1->fetch_assoc()){?>
            <tr>
                <td><?php echo $rows_1['ID'];?></td>
                <td><?php echo $rows_1['product_name'];?></td>
                <td><?php echo $rows_1['product_description'];?></td>
                <td><?php echo $rows_1['product_type'];?></td>
                <td><?php echo $rows_1['details'];?></td>
            </tr>
        <?php } ?>
        </table>

        <hr>
        
         <!-- Đăng kí hang hóa -->

        <h4> Đăng kí hàng hóa<h4>
                <?php
                    if(isset( $alert_create_product)){
                        echo  $alert_create_product;
                    }
                ?>
        <form action="kho_hang.php" method="POST">
            <span>Tên</span><br>
            <input type="text" name="product_name" id=""><br>
            <span>Mô tả</span><br>
            <input type="text" name="product_description" id=""><br>
            <span>Loại hàng hóa</span><br>
            <input type="text" name="product_type" id=""><br>
            <span>Chú thích</span><br>
            <input type="text" name="details" id=""><br>
            <input type="submit" name="create_product" value="Create">    
        </form>
    <hr>
        
        <!-- Tạo phiếu -->

       <h4> Tạo phiếu <h4>
                <?php
                    if(isset( $alert_2)){
                        echo  $alert_2;
                    }
                ?>
       <form action="kho_hang.php" method="POST">
            <span>Tên Người nhập</span><br>
            <span>Xuất /Nhập</span><br>
            <select name="order_type" id="">
                    <option value="import"> Nhập</option>
                    <option value="export"> Xuất</option>
            </select><br>
            <span>Lí do</span><br>
            <textarea name="order_reason" id="" cols="30" rows="10"></textarea><br>
            <span>Ngày tạo phiếu </span><br>
            <input type="text" name="date" id=""><br>
            <span>Chú thích</span><br>
            <input type="text" name="details" id=""><br>
            <input type="submit" name="create_order" value="Create">    
       </form>
   <hr>
   <!-- nhap -->

   <h4> Nhập hàng hóa <h4>
       <form action="kho_hang.php" method="POST">
            <span>Nhập ID product</span><br>
            <input type="text" name="product_ID" id=""><br>
            <span>ID product</span><br>
            <select name="product_ID_f" id="">
                    <option value="none">none</option>
                    <?php while($row_3 = $query_3->fetch_assoc()){?>
                        <option value="<?php echo $row_3['ID']?>"><?php echo $row_3['product_name']?></option>
                    <?php } ?>
            </select><br>   
            <span>Từ Kho</span><br>
            <select name="invenID" id="">
                <?php while($row_2 = $query_2->fetch_assoc()){?>
                    <option value="<?php echo $row_2['ID']?>"><?php echo $row_2['ten_kho']?></option>
                    <?php } ?>
            </select><br>    
            <span>Số lượng</span><br>
            <input type="text" name="quantity" id=""><br>
            <input type="submit" name="import_order" value="ok">    
       </form>
   <hr>
      <!-- nhap -->
     <button onclick="location.href='kho_hang.php?order_status=done&order_id=<?php echo $row_4['ID']?>'">Hoàn thành</button>
      <h4>danh sách các hàng hóa trong phiếu<h4>
         <h4>ID phiếu : <?php echo $row_4['ID']?></h4>
        <table border="1">
            <tr>
                <td>ID product</td>
                <td>Tên hàng hóa</td>
                <td>TKho</td>
                <td>Số lượng</td>
            </tr>
        </table>
   <hr>
