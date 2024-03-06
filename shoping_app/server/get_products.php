<?php
  include('config.php');

  $stmt = $conn->prepare("SELECT*FROM products WHERE product_category='products' product_price=? LIMIT 4");

  $stmt->execute();

  $total_products = $stmt->get_result();

?>