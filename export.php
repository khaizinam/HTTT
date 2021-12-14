<?php include('partials-front/menu.php'); ?>
    <div class="container-fluid">
        <h3 class='text-center'>Export Form</h3>
        <a href="<?php echo SITE_URL; ?>order.php"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 30px;"></i></a> 
    </div>
    <div class="container-xl product">
            <div class='w-100'>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Item" id='keyword' autocomplete="off">
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
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11;">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #ff6b81;">
            <div class="toast-header">
            <strong class="me-auto">System Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast()"></button>
            </div>
            <div class="toast-body">
            <b>Out of stock!!</b>
            </div>
        </div>
        <div id="liveToast4" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #ff6b81;">
            <div class="toast-header">
            <strong class="me-auto">System Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast4()"></button>
            </div>
            <div class="toast-body">
            <b>Must be higher than 0!!</b>
            </div>
        </div>
        <div id="liveToast3" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #7bed9f;">
            <div class="toast-header">
            <strong class="me-auto">System Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast3()"></button>
            </div>
            <div class="toast-body">
            <b>Remove Successfully!!</b>
            </div>
        </div>

        <div id="liveToast2" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #7bed9f;">
            <div class="toast-header">
            <strong class="me-auto">System Message</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast2()"></button>
            </div>
            <div class="toast-body">
            <b>Add Successfully!!</b>
            </div>
        </div>
    </div>
    <div class="container-xl border" style="margin-top: 10px;">
        <h4>Items to be exported</h4>
        <div class='table-responsive-xl'>
            <table class="table" id="result2">
                <thead>
                    <tr>
                        <th scope="col">Item Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warehouse Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_COOKIE['cart-exported']))
                        {
                            $cookie_data = stripslashes($_COOKIE["cart-exported"]);
                            $cart_data = json_decode($cookie_data, true);
                            $data_length = 0;
                            foreach($cart_data as $key => $value)
                            {
                                $data_length++;
                                $warehouse_id = $value["warehouse_id"];
                                $product_id = $value["product_id"];

                                $sql4 = "SELECT name from warehouse WHERE id = $warehouse_id";

                                $res4 = mysqli_query($conn, $sql4);
                                
                                $row4 = mysqli_fetch_assoc($res4);
                            
                                $warehouse_name = $row4['name'];
                            
                                $sql3 = "SELECT name from product WHERE id = $product_id";
                            
                                $res3 = mysqli_query($conn, $sql3);
                                
                                $row3 = mysqli_fetch_assoc($res3);
                            
                                $product_name = $row3['name'];
                                ?>
                                <tr class="prop itemCartremove<?php echo $value['item_id']; ?> res d-none">
                                    <td><?php echo $value["item_name"]; ?></td>
                                    <td><?php echo $value['sku']; ?></td>
                                    <td>
                                        <div class="input-group" style='width:150px; flex-wrap: nowrap;'>
                                            <div class="input-group-prepend" style='cursor:pointer' onclick="decTotal(this)">
                                                <span class="input-group-text">-</span>
                                            </div>
                                            <input type="hidden" name="in_stock" class="in_stock" value="<?php echo $value['quantity'] ?>">
                                            <input type="number" class="form-control quantity-item" value='<?php echo $value["item_quantity"]; ?>' name="quantity[]" onchange="input_change(this)">
                                                <form class="quantityForm">
                                                    <input class="item_id" type="hidden" name="id" value="<?php echo $value['item_id']; ?>">
                                                </form>
                                            <div class="input-group-append" style='cursor:pointer' onclick="incTotal(this)">
                                                <span class="input-group-text">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $warehouse_name; ?></td>
                                    <td><?php echo $product_name; ?></td>
                                    <td><?php echo $value['supplier']; ?></td>
                                    <td>
                                        <form class="remove<?php echo $value['item_id']; ?>Form">
                                            <input type="hidden" value="<?php echo $value['item_id']; ?>" name="id-remove">
                                            <button type="button" class="btn btn-danger" id="remove<?php echo $value['item_id']; ?>" onclick="removeCart(this.id)" name="removeBtn">Delete Item</button>
                                        </form>
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
                    if(isset($_COOKIE['cart-exported']))
                    {
                        if(ceil($data_length / 10) >= 2)
                    {
                        echo "<li class='btn btn-primary active' onclick='changePage(1)'>1</li>";
                    for($i = 2; $i <= ceil($data_length / 10) && $i <= 6;$i++){
                        echo "<li class='btn btn-primary' onclick='changePage(".$i.")'>".$i."</li>";
                    }
                    }
                    }
                    ?>
            </ul>
            <form action="<?php echo SITE_URL; ?>confirm-export.php">
                <button type="submit" class="btn btn-primary" id="export" style="float: right; margin-bottom: 10px; margin-top: 10px;" disabled>Export</button>
            </form>
        </div>
    </div>

<script>
    if(document.querySelector('.prop') != null)
    {
        $('#export').prop('disabled', false);
    }
    const result2 = document.getElementById('result2');

    function closeToast()
    {
        $('#liveToast')[0].classList.remove('show');
        $('#liveToast')[0].classList.add('hide');
    }

    function closeToast2()
    {
        $('#liveToast2')[0].classList.remove('show');
        $('#liveToast2')[0].classList.add('hide');
    }

    function closeToast3()
    {
        $('#liveToast3')[0].classList.remove('show');
        $('#liveToast3')[0].classList.add('hide');
    }

    function closeToast4()
    {
        $('#liveToast4')[0].classList.remove('show');
        $('#liveToast4')[0].classList.add('hide');
    }

    function removeCart(e) {
        var a = ".itemCart" + e;
        var f = "." + e + "Form";
        var form = document.querySelector(f);
        let xhr = new XMLHttpRequest()
        xhr.open("POST", "remove-export.php");
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    console.log(data);
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);

        document.querySelector(a).remove();
        if(document.querySelector('.prop') == null)
        {
            $('#export').prop('disabled', true);
        }
        $('#liveToast3')[0].classList.remove('hide');
        $('#liveToast3')[0].classList.add('show');
    };

    // $('.quantity-item').bind("change", function(){
    //     var check = parseInt($(this).val());
    //     var in_stock = $(this).parent()[0].querySelector(".in_stock").value;
    //     var id = $(this).parent()[0].querySelector(".item_id").value;
    //     if(check > in_stock)
    //     {
    //         check = in_stock;
    //         $(this).parent()[0].querySelector(".quantity-item").value = in_stock;
    //         $('#liveToast')[0].classList.remove('hide');
    //         $('#liveToast')[0].classList.add('show');
    //     }
    //     console.log(check);
    //     let xhr = new XMLHttpRequest();
    //         xhr.open("GET", "export-change.php?id=".concat(id)+"&quantity=".concat(check),true);
    //         xhr.onload = ()=>{
    //             if(xhr.readyState === XMLHttpRequest.DONE){
    //                 if(xhr.status === 200){
    //                     let data = xhr.response;
    //                     console.log(data);
    //                 }
    //             }
    //         }
    //     xhr.send();
    // });

    function input_change(t){
        var check = parseInt(t.value);
        var in_stock = t.parentElement.querySelector(".in_stock").value;
        var id = t.parentElement.querySelector(".item_id").value;
        if(check > in_stock)
        {
            check = in_stock;
            t.parentElement.querySelector(".quantity-item").value = in_stock;
            $('#liveToast')[0].classList.remove('hide');
            $('#liveToast')[0].classList.add('show');
        }
        if(check <= 0)
        {
            check = 1;
            t.parentElement.querySelector(".quantity-item").value = 1;
            $('#liveToast4')[0].classList.remove('hide');
            $('#liveToast4')[0].classList.add('show');
        }
        console.log(id);
        let xhr = new XMLHttpRequest();
            xhr.open("GET", "export-change.php?id=".concat(id)+"&quantity=".concat(check),true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        console.log(data);
                    }
                }
            }
        xhr.send();
    }

    function addItem(id)
    {
        $('#export').prop('disabled', false);
        var tmp = ".itemCartremove"+id;
        var item = document.querySelector(tmp);

        if(document.querySelector(tmp) != null)
        {
            var quantity = parseInt(item.querySelector(".in_stock").value);
            var check = parseInt(item.querySelector(".quantity-item").value) + 1;
            console.log(quantity);
            if(check <= quantity)
            {
                item.querySelector(".quantity-item").value = parseInt(item.querySelector(".quantity-item").value) + 1;
                // console.log($('#liveToast2')[0]);
                $('#liveToast2')[0].classList.remove('hide');
                $('#liveToast2')[0].classList.add('show');
            }
            else
            {
                //console.log($('#liveToast')[0]);
                $('#liveToast')[0].classList.remove('hide');
                $('#liveToast')[0].classList.add('show');
                return;
            }
        }
        else
        {
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "export-item.php?id=".concat(id),true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        //console.log(data);
                        var newElement = document.createElement('tbody');
                        newElement.innerHTML = xhr.response;
                        // result2.insertAdjacentHTML( "beforeend", data);
                        result2.appendChild(newElement);
                    }
                }
            }
            xhr.send();
            // console.log($('#liveToast2')[0]);
            $('#liveToast2')[0].classList.remove('hide');
            $('#liveToast2')[0].classList.add('show');
        }
        let xhr = new XMLHttpRequest();
                xhr.open("GET", "cart-exported-item.php?id=".concat(id),true);
                xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            console.log(data);
                        }
                    }
                }
            xhr.send();
    }
    function incTotal(t){
        var quantity = parseInt(t.parentElement.querySelector(".in_stock").value);
        var check = parseInt(t.parentElement.querySelector(".quantity-item").value) + 1;
        if(check <= quantity)
        {   
            t.parentElement.querySelector(".quantity-item").value = check;
            form = t.parentElement.querySelector(".quantityForm");
            let xhr = new XMLHttpRequest();
                xhr.open("POST", "inc-exported.php");
                xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            console.log(data);
                        }
                    }
                }
            
            let formData = new FormData(form); //Create new formData Object
            xhr.send(formData); //sending the form data to php
        }
        else
        {
            //console.log($('#liveToast')[0]);
            $('#liveToast')[0].classList.remove('hide');
            $('#liveToast')[0].classList.add('show');
        }
    }

    function decTotal(t){
        var check = parseInt(t.parentElement.querySelector(".quantity-item").value) - 1;
        if(check >= 1){
            t.parentElement.querySelector(".quantity-item").value = check;
            form = t.parentElement.querySelector(".quantityForm");
            let xhr = new XMLHttpRequest();
                xhr.open("POST", "dec-exported.php");
                xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            console.log(data);
                        }
                    }
                }
            let formData = new FormData(form); //Create new formData Object
            xhr.send(formData); //sending the form data to php
        }
        else
        {
            $('#liveToast4')[0].classList.remove('hide');
            $('#liveToast4')[0].classList.add('show');
        }
    }
</script>
<script src="public/js/fragment.js"></script>
<script src="public/js/search.js"></script>
<?php include('partials-front/footer.php'); ?>