<?php
        class DataBase  
        {
              public $host= HOSTNAME;
              public $name= USERTNAME;
              public $pass= PASS;
              public $database= DATABASEBNAME;
      
              public $link;
              public $eror;
              public  function __construct()
              {
                  $this->connectDB();
              }
              public function connectDB(){
                      $this->link = new mysqli($this->host,$this->name,$this->pass,$this->database);
                      if (!$this->link) {
                          $this->eror = "Connect fail".$this->link->connect_error;
                          return false;
                      }
              }
            public function get_req($query){
                $result = $this->link->query($query) or 
                die($this->link->error.__LINE__);
                return $result;
            }
            public function get_check($query){
                $result = $this->link->query($query) or 
                die($this->link->error.__LINE__);
                if($result->num_rows > 0){
                    return $result;
                }else { 
                    return false;
                }     
            }
            public function send_req($query){
                    $this->link->query($query) or 
                    die($this->link->error.__LINE__);      
            }
        }  
        //kho hang
        class warehouse{
            public $db;
            //goi data
            public  function __construct()
            {
                $this->db = new DataBase();
            }
            //tạo kho hàng mới
            public function create_new(){
                $name = $_POST['warehouse_name'];
                $adress = $_POST['warehouse_adress'];
                if(empty($name)){
                    $alert = 'Vui lòng điền tên khi hàng';
                    return $alert;
                }else{
                    $query_1 = "SELECT * FROM kho_hang WHERE ten_kho = '".$name."'";
                    $result = $this->get_req($query_1);
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        $alert = 'Tên đã tồn tại';
                        return $alert;
                    }else{
                        $query="INSERT INTO kho_hang(ten_kho,adress) VALUE ('".$name."','".$adress."')"; //INSERT hear
                        $this->send_req($query); 
                        $alert = 'đã tạo thành công';
                        return $alert;
                    }
                }  
            }
            //gọi danh sách các kho hàng đang có
            public function show(){
                $query="SELECT * FROM kho_hang ORDER BY ID ASC";
                $result = $this->get_req($query); 
                return $result;
            }
            public function show_id($id){
                $query="SELECT * FROM kho_hang WHERE ID = '".$id."' LIMIT 1"; 
                $result = $this->get_req($query); 
                return $result;
            }
            public function show_item(){
                $id = $_POST['kho_hang_ID'];
                $query="SELECT `hang_hoa`.`ID`,`product`.`product_name`, `hang_hoa`.`supplier_name`, `hang_hoa`.`productID`, `hang_hoa`.`quantity` FROM `hang_hoa` INNER JOIN `product` ON  `hang_hoa`.`productID` = `product`.`ID` WHERE `invenID`='".$id."'";
                $result = $this->get_req($query); 
                return $result;
            }
            public function send_req($query){
                $this->db->send_req($query);
            }
            public function get_req($query){
                $result = $this->db->get_req($query);
                return $result;
            }
        }


       class phieu_xuat_nhap{
            public $db;
            //goi data
            public  function __construct()
            {
                $this->db = new DataBase();
            }
            //tao phieu nhap
            public function create_new(){
                $query="SELECT * FROM phieu_xuat_nhap WHERE NOT order_status='done'";
                $relt = $this->get_req($query);
                $num = mysqli_num_rows($relt);
                //POST SEVER REQUEST
                $order_type = $_POST['order_type'];
                $order_reason = $_POST['order_reason'];
                $date = $_POST['date'];
                $details = $_POST['details'];
                if($num > 0){
                    $alert = 'Phiếu xuất nhập trước chưa hoàn thành'.$num;
                    return $alert;
                } else{
                    $query_1 ="INSERT INTO phieu_xuat_nhap(order_type, order_reason, createAt , details) VALUES ('".$order_type."', '".$order_reason."', '".$date."', '".$details."')";
                    $this->send_req($query_1);
                    $alert = 'Tạo thành công';
                    return $alert;
                }
                
            }
            public function close($id){
                $query="UPDATE phieu_xuat_nhap SET order_status='done' WHERE ID='".$id."'";
                $result = $this->get_req($query); 
                return $result;
            }
            public function show(){
                $query="SELECT * FROM phieu_xuat_nhap WHERE NOT order_status='done' LIMIT 1"; //INSERT hear
                $result = $this->get_req($query);  
                return $result;
            }
            public function action($type,$productID,$quantity,$invenID){
                if($type == 'import')
                {
                    $query_1= "SELECT * FROM hang_hoa WHERE productID='".$productID."' AND invenID='".$invenID."'";
                    
                }
                else if ($type == 'export'){

                }
            }
            //get & send
            public function send_req($query){
                $this->db->send_req($query);
            }
            public function get_req($query){
                $result = $this->db->get_req($query);
                return $result;
            }
        }
        class product{
            public $db;
            //goi data
            public  function __construct()
            {
                $this->db = new DataBase();
            }
            public function create_new(){
                $product_name = $_POST['product_name'];
                $product_description = $_POST['product_description'];
                $product_type = $_POST['product_type'];
                $details = $_POST['details'];
                if(empty($product_name)){
                    $alert = 'Vui lòng điền tên khi hàng';
                    return $alert;
                }else{
                    $query_1 = "SELECT * FROM product WHERE product_name = '".$product_name."'";
                    $result = $this->get_req($query_1);
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        $alert = 'Tên đã tồn tại';
                        return $alert;
                    }else{
                        $query="INSERT INTO product(product_name,product_description,product_type,details) VALUES ('".$product_name."','".$product_description."','".$product_type."','".$details."')"; //INSERT hear
                        $this->send_req($query); 
                        $alert = 'đã tạo thành công';
                        return $alert;
                    }
                }  
            }
            public function show(){
                $query="SELECT * FROM product ORDER BY ID ASC";
                $result = $this->get_req($query); 
                return $result;
            }
            public function show_id($id){
                $query="SELECT * FROM product WHERE ID = '".$id."'"; 
                $result = $this->get_req($query); 
                return $result;
            }
            public function send_req($query){
                $this->db->send_req($query);
            }
            public function get_req($query){
                $result = $this->db->get_req($query);
                return $result;
            }


        }
?>