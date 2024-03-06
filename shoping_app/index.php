<?php
include('server/config.php');

?>
<?php include('layouts/header.php');?>

    <!-- Home -->
    <section id="home">
      <div class="container">
        <h5>New Arrivals</h5>
        <h1><span>Best Prices</span> For this seeson</h1>
        <p>Esop offers the best products for the most affordable price</p>
        <button>Shop Now</button>
      </div>
    </section>
    
    <!-- Brand -->
    <section id="brand" class="container mt-2">
      <div class="row">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.png" alt="brand-img">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.jpg" alt="brand-img">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.webp" alt="brand-img">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png" alt="brand-img">
      </div>
    </section>

    <!-- shop -->
    <section id="new">
         <div class="row p-0 m-0 mt-2">
            <!-- one -->
           <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
           <a href="#watches"> <!-- Added anchor link -->
                <img src="assets/imgs/shop1.jpeg" alt="img1">
                <div class="details">
                    <h2>Extremely Awesome Shop</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </a>
           </div>
           <!-- two -->
           <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
           <a href="#bags"> <!-- Add anchor link -->
                <img src="assets/imgs/shop2.jpeg" alt="img3">
                <div class="details">
                    <h2>Extremely Awesome Shop</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </a>
          </div>
           <!-- three -->
           <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
           <a href="#heels"> <!-- Add anchor link -->
                <img src="assets/imgs/img1.webp" alt="img1">
                <div class="details">
                    <h2>Extremely Awesome Shop</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </a>
         </div>
    </section>
   
    <!-- featured -->
    <section id="features" class="pb-5 my-5">
       <div class="container text-center mt-5 py-5">
         <h3>Our Featured</h3>
         <hr>
         <p>Here you can check out our featured products</p>
       </div>
       <div class="row mx-auto container-fluid">
        <?php
          include('server/get_featured_products.php');
        ?>
        
        <?php while($row=$featured_products->fetch_assoc()) { ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <!-- using php here -->
           <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>" alt="image">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
           <h5 class="p-name"><?php echo $row['product_name']?></h5>
           <h4 class="p-price"><?php echo $row['product_price']?></h4>
           <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>  
      <?php  } ?>
        </div>
    </section>

    <!-- banner -->
    <section id="banner" class="py-5 my-5">
     <div class="container" style="margin-left: 70%;">
      <h4>MID SEASON'S SALE</h4>
      <h1>Autumn Collection <br> UP to 30% OFF</h1>
      <button class="text-uppercase">shop now</button>
     </div>
    </section>

    <!-- cloths -->
    <section id="features" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Dresses</h3>
        <hr>
        <p>Here you can check out our amazing clothes</p>
      </div>
      <div class="row mx-auto container-fluid">
        <!-- php -->
        <?php include('server/get_dress.php') ?>
        <?php while($row=$dress->fetch_assoc()) { ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
           <div class="star">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
           </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
          
       </div>

      <?php  } ?>
      </div>
    </section>

    <!-- heels -->
    <section id="heels" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Heels</h3>
      <hr>
      <p>Here you can check out our amazing Heels</p>
    </div>
    <div class="row mx-auto container-fluid">
    <?php include('server/get_heels.php') ?>
    <?php while($row=$heels->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3 small-image" src="assets/imgs/<?php echo $row['product_image']?>" alt="">
         <div class="star">
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
         </div>
        <h5 class="p-name"><?php echo $row['product_name']?></h5>
        <h4 class="p-price"><?php echo $row['product_price']?></h4>
        <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">
        <button class="buy-btn">Buy Now</button></a>
     </div>
    <?php } ?>
    </section>

    <!-- watches -->
    <section id="watches" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Watches</h3>
        <hr>
        <p>Here you can check out our amazing watches</p>
      </div>
      <div class="row mx-auto container-fluid">

      <?php include('server/get_watches.php') ?>
      <?php while($row=$watch->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']?>" alt="">
           <div class="star">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
           </div>
          <h5 class="p-name"><?php echo $row['product_name']?></h5>
          <h4 class="p-price"><?php echo $row['product_price']?></h4>
          <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">
          <button class="buy-btn">Buy Now</button></a>
       </div>
      <?php } ?>
    
    </section>

    <!-- Bags -->
    <section id="bags" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Bags</h3>
        <hr>
        <p>Here you can check out our amazing bags</p>
      </div>

      <div class="row mx-auto container-fluid">
      <?php include('server/get_bags.php') ?>
      <?php while($row=$bags->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']?>" alt="img">
           <div class="star">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
           </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
          <button class="buy-btn">Buy Now</button></a>
       </div>
      <?php } ?>
       
    </section>
    
   <?php include('layouts/footer.php');?>