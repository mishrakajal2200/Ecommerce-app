<?php
session_start();

include('config.php');

// eshtablish a database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password,$dbname,);
// if user is not logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;
    // if user is logged in
}else{
    if(isset($_POST['place_order'])){
        //1. get user info and store it in database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "not paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('y-m-d H:i:s');
    
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$order_cost, $order_status, $user_id, $phone, $city, $address, $order_date]);
        $order_id = $conn->insert_id;
        echo $order_id;
    
        // 2.issue new order and store order indatabse
        $order_id = $conn->insert_id;
    
        //3. get products from cart(from session)
        foreach($_SESSION['cart'] as $key=>$value){
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
           
        //   4.store each single item in order items databse
            $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price,product_quantity, user_id,order_date)VALUES(?, ?, ?, ?, ?, ?, ?,?)"); 
            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price,$product_quantity,$user_id,$order_date);
            $stmt1->execute();
            // $stmt1->execute([$order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date]);
    
            
    
        }
        
            //5. remove everything from cart -> delay until payment is done
    
            //6. inform user whether everthing is fine or there is a problem
            header('location:../payment.php?order_status="order placed successfully"');
    }
    
}



?>