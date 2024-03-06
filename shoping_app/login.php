<?php
session_start();

include('server/config.php');

if(isset($_SESSION['logged_in'])){
  header('location:account.php');
}

if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']); 

  $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ?");
  $stmt->bind_param('s', $email);

  if($stmt->execute()){
    $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
    $stmt->store_result();
    if($stmt->num_rows() == 1){
      $stmt->fetch();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header('location:account.php?login_success=logged in successfully');
    
    } else {
      header('location:login.php?error=Could not verify your account');
    }
  } else {
    // Error
    header('location:login.php?error=Something went wrong');
  }
}
?>



<?php include('layouts/header.php');?>

    <!-- Login -->
      <section class="my-5 py-5">

        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Login</h2>
          <hr class="mx-auto">
        </div>
        
        <div class="mx-auto container">
          <form id="login-form" method="POST" action="login.php">
          <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group">
                 <label for="email">Email:</label>
                 <input type="text" class="form-control" id="login-email" name="email" placeholder="email" required/>
            </div><br>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="login-password" placeholder="password" name="password" required/>
           </div><br>

           <div class="form-group">
            <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
           </div><br>

           <div class="form-group">
            <a class="btn" id="register-url" href="register.php">Don't have an account? Register</a>
           </div><br>

          </form>
        </div>
      </section>
   
      <?php include('layouts/footer.php');?>