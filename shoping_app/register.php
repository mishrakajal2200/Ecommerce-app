<?php
session_start();
include('server/config.php');

// if user has already registered
if(isset($_SESSION['logged_in'])){
  header('location:account.php');
  exit;
}

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $confirmPassword = md5($_POST['confirmPassword']);

  // if password don't match
  if($password !== $confirmPassword){
    header('location:register.php?error=password dont match');
  }
  // if password less then 6 caracters
  else if(strlen($password)<6){
    header('location:register.php?error=password must be at 6 characters');
  }
  // if there is no error
  else{
  // check whether there is a user with this email or not
  $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
  $stmt1->bind_param('s',$email);
  $stmt1->execute();
  $stmt1->bind_result($num_rows);
  $stmt1->store_result();
  $stmt1->fetch();
  //  if user already register with this email
  if($num_rows !== 0){
    header('location:register.php?error=user with this email already register');

    // if no user register with this email
  }else{
    // create new user
    $stmt = $conn->prepare("INSERT INTO users(user_name,user_email,user_password)
             VALUES(?,?,?)");
  
    $stmt->bind_param('sss',$name,$email,md5($password));

    // if account was created successfully
   if($stmt->execute()){
    $user_id = $conn->lastInsertId();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['logged_in'] = true;
    header('location:account.php?register_success=you registered successfully');


    // account could not be created
   }else{
       header('location:register.php?error=could not create an account at the moment');
   }
}
  }  
}


?>
        <!-- Header section -->
<?php include('layouts/header.php');?>

    <!-- Register -->
      <section class="my-5 py-5">

        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Register</h2>
          <hr class="mx-auto">
        </div>
        
        <div class="mx-auto container">
          <form id="register-form" method="POST" action="register.php">
            <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required>
           </div><br>

            <div class="form-group">
                 <label for="email">Email:</label>
                 <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required>
            </div><br>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required>
           </div><br>

           <div class="form-group">
            <label for="confirm-Password">Password:</label>
            <input type="password" class="form-control" id="register_confirm_password" name="confirmPassword" placeholder="confirm-Password" required>
            </div><br>

           <div class="form-group">
            <input type="submit" class="btn" id="register-btn" value="Register" name="register" placeholder="submit" required>
           </div><br>

           <div class="form-group">
            <a class="btn" id="login-url" href="login.php">Do you have an account? Login</a>
           </div><br>
          </form>
        </div>
      </section>

    <!-- footer -->
    <?php include('layouts/footer.php');?>