<?php
session_start();
include('server/config.php');

if(isset($_POST['order_pay_btn'])){
  $order_status = $_POST['order-status'];
  $order_total_price = $_POST['order_total_price'];
}
?>

<?php include('layouts/header.php');?>

      <!-- payment -->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Payment</h2>
          <hr class="mx-auto">
        </div>
        
        <div class="mx-auto text-center container">
        
        <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
        <p>Total Payment: $<?php echo $_SESSION['total']; ?></p>
        <input type="submit" class="btn btn-primary" value="Pay Now">

        <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
          <p>Total Payment: $<?php echo $_SESSION['order_total_price']; ?></p>
          <input type="submit" class="btn btn-primary" value="Pay Now">

        <?php } else { ?>
          <p>You Don't have an Order</p>
        <?php  } ?>
       
      </section>


      <?php include('layouts/footer.php');?>