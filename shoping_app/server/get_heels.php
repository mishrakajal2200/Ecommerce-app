<?php
  include('server/config.php');

  $stmt = $conn->prepare("SELECT*FROM products WHERE product_category='heels' LIMIT 4");

  $stmt->execute();

  $heels = $stmt->get_result();

?>