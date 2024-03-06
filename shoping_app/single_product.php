<!-- php -->
<?php

 include('server/config.php');

 if(isset($_GET['product_id'])){
 
 $product_id = $_GET['product_id'];
 $stmt = $conn->prepare("SELECT*FROM products WHERE product_id=?");
 $stmt->bind_param('i',$product_id);
 $stmt->execute();

  $product = $stmt->get_result();//[]

  //no product id was given
}else{
    header('location:index.php');
  };
?>


<?php include('layouts/header.php');?>

    <!-- single_product -->
    <section class="container  single_product my-5 mt-5">
      <div class="row mt-5">
        <!-- php -->
        <?php while($row=$product->fetch_assoc()) { ?>
      


         <div class="col-lg-5 col-lg-6 col-sm-12">
            <img class="img-fluid w-100 pb-1 mt-5" src="assets/imgs/<?php echo $row['product_image'];?>" alt="image" id="mainImage">
            <div class="small-img-group">
               <div class="small-img-col">
                  <img class="small-img" width="100%" src="assets/imgs/<?php echo $row['product_image'];?>" alt="image">
               </div>
               <div class="small-img-col">
                <img class="small-img" width="100%"  src="assets/imgs/<?php echo $row['product_image2'];?>" alt="image">
             </div>
             <div class="small-img-col">
                <img class="small-img" width="100%"  src="assets/imgs/<?php echo $row['product_image3'];?>" alt="image">
             </div>
             <div class="small-img-col">
                <img class="small-img" width="100%"  src="assets/imgs/<?php echo $row['product_image4'];?>" alt="image">
             </div>
            </div>
         </div>
        
         <div class="col-lg-6 col-md-12 col-12 mt-5">
            <h6>Girl's/Footwears</h6>
            <h3 class="py-4"><?php echo $row['product_name'];?></h3>
            <h2><?php echo $row['product_price'];?></h2>

            <form action="cart.php" method="POST" >
            <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>"/>
            <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>"/>
            <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>"/>
            <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>"/>

            <input type="number" name="product_quantity" value="1">
            <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
            </form>
            <h4 class="mt-5 mb-5">Product Details</h4>
            <span><?php echo $row['product_description'];?>
            </span>
         </div>
         
         <?php } ?>
      </div>
    </section>

    <!-- related products
    <section id="related-products" class="pb-5 my-5">

        <div class="container text-center mt-5 py-5">
          <h3>Related Products</h3>
        </div>
        <div class="row mx-auto container-fluid">
         <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/img1.webp" alt="image" id="mainImage">
             <div class="star">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
             </div>
            <h5 class="p-name">sports shoes</h5>
            <h4 class="p-price">$199.8</h4>
            <button class="buy-btn">Buy Now</button>
         </div>
 
         <div class="product text-center col-lg-3 col-md-4 col-sm-12">
           <img class="img-fluid mb-3" src="assets/imgs/img2.jpg" alt="image" >
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
           <h5 class="p-name">sports shoes</h5>
           <h4 class="p-price">$199.8</h4>
           <button class="buy-btn">Buy Now</button>
         </div>
 
         <div class="product text-center col-lg-3 col-md-4 col-sm-12">
         <img class="img-fluid mb-3" src="assets/imgs/img3.webp" alt="image">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
         <h5 class="p-name">sports shoes</h5>
         <h4 class="p-price">$199.8</h4>
         <button class="buy-btn">Buy Now</button>
         </div>
 
         <div class="product text-center col-lg-3 col-md-4 col-sm-12">
       <img class="img-fluid mb-3" src="assets/imgs/img4.webp" alt="image">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
       <h5 class="p-name">sports shoes</h5>
       <h4 class="p-price">$199.8</h4>
       <button class="buy-btn">Buy Now</button>
         </div>
        </div>
     </section> -->

   

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->

    <script type="text/javascript">
       var mainImage = document.getElementById("mainImage");
       var smallImage = document.getElementsByClassName("small-img");

      //  smallImage[0].onclick = function(){
      //      mainImage.src = smallImage[0].src;
      //  }
      //  smallImage[1].onclick = function(){
      //      mainImage.src = smallImage[1].src;
      //  }
      //  smallImage[2].onclick = function(){
      //      mainImage.src = smallImage[2].src;
      //  }
      //  smallImage[3].onclick = function(){
      //      mainImage.src = smallImage[3].src;
      //  }

      for(let i=0; i<4; i++){
        smallImage[i].onclick = function(){
           mainImage.src = smallImage[i].src;
       }
      }
    </script>

<?php include('layouts/footer.php');?>