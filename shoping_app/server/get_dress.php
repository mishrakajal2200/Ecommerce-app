<?php
  include('server/config.php');

  $stmt = $conn->prepare("SELECT*FROM products WHERE product_category='dress' LIMIT 4");

  $stmt->execute();

  $dress = $stmt->get_result();

?>