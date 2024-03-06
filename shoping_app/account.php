<?php
session_start();

include('server/config.php');

// if(isset($_SESSION['logged_in'])){
//   header('location:login.php');
//   exit;
// }

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location:login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  // if password don't match
  if($password !== $confirmPassword){
    header('location:account.php?error=password dont match');
   
  }
  // if password less then 6 caracters
  else if(strlen($password)<6){
    header('location:account.php?error=password must be at 6 characters');
  
  }
  // no error
  else{
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss',md5($password),$user_email);

    if($stmt->execute()){
      header('location:account.php?message=password has been updated successfully');
      
    }else{
      header('location:account.php?error=could bot update password');
      
    }
  }
  
  // get orders

}

// get orders
if(isset($_SESSION['logged_in'])){
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT*FROM orders WHERE user_id=?");
  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $order_details = $stmt->get_result();
}

?>
<?php include('layouts/header.php');?>

    <!-- Account -->
      <section class="my-5 py-5">
        <div class="row container mx-auto">
          <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
          <p style="color:green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];}?></p>
          <p style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];}?></p>
            <h3 class="font-weight-bold">Account Info</h3>
            <hr class="mx-auto">
            <div class="account-info">
              <p>Name<span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
              <p>Email<span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
              <p><a href="#orders" id="order-btn" >Your Orders</a></p>
              <p><a href="account.php?logout=1" id="logout-btn" name="logout" >Logout</a></p>
               
            </div>
          </div>

          <div class="col-lg-6 col-md-12 col-sm-12">
              <form method="POST" action="account.php" id="account-form">
              <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
              <p style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>
                <h3>Change Password</h3>
                <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" class="form-control" id="account-password" name="password" placeholder="password" required/>
                </div>

                <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="confirm-password" required/>
                </div>

                <div class="form-group">
                   <input type="submit" value="change-password" name="change_password" id="change-password"/>
                </div>
              </form>
          </div>
        </div>
      </section>


    <!-- orders -->
    <section id="orders" class="order container my-5 py-5">
        <div class="container mt-5">
          <h2 class="font-weight-bold text-center">Your Orders</h2>
          <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
           <tr>
               <th>Order id</th>
               <th>Order cost</th>
               <th>Order status</th>
               <th>Order date</th>
               <th>Order details</th>
               
           </tr> 

           <?php while($row = $order_details->fetch_assoc()) { ?>
            <tr>
               <td>
                   <span><?php echo $row['order_id']?></span>
               </td>

               <td>
                 <span><?php echo $row['order_cost']?></span>
               </td>

               <td>
                 <span><?php echo $row['order_status']?></span>
               </td>

               <td>
                 <span><?php echo $row['order_date']?></span>
               </td>

               <td>
               <form method="POST" action="order_details.php">
                    <input type="hidden" value="<?php echo $row['order_status']?>" name="order_status"/>
                    <input type="hidden" value="<?php echo $row['order_id']?>" name="order_id"/>
                    <input type="submit" class="btn order-details-btn" name="order_details_btn" value="details"/>
                 </form>
               </td>
           </tr> 
          <?php } ?>
        </table>

        
        <!-- <div class="cart-total">
           <table>
               <tr>
                   <td>SubTotal</td>
                   <td>$170</td>
               </tr>

               <tr>
                   <td>Total</td>
                   <td>$170</td>
               </tr>

           </table>
        </div> -->
        
   </section>

   <?php include('layouts/footer.php');?>