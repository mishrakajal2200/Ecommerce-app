<?php

session_start();

include('server/config.php');

// // Initialize $products variable
// $products = null;
// // $total_records = null;
 $total_products = null;
// $total_no_of_pages = null;
// $page_no = 3;
// use the search section
if(isset($_POST['search'])){

  // 1.determine page number
  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET['page_no'];
  }else{
    // if user just entered the page then default page is 1
    $page_no = 1;
  }

  $category = $_POST['category'];
  $price = $_POST['price'];

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si',$category,$price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. product per page
  $total_records_per_page = 8;
  $offset = ($page_no-1)* $total_records_per_page ;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page );

  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?  LIMIT $offset,$total_records_per_page");
  $stmt2->bind_param('si',$category,$price);
  $stmt2->execute();
  $products = $stmt2->get_result();

  // $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
  // $stmt->bind_param('si',$category,$price);
  // $stmt->execute();
  // $product=$stmt->get_result();

  

  // return all products
}else{
  // 1.determine page number
  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET['page_no'];
  }else{
    // if user just entered the page then default page is 1
    $page_no = 1;
  }

  
  //2. return number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  //3. product per page
  $total_records_per_page = 1;
  $offset = ($page_no-1)* $total_records_per_page ;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page );

  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result();

  
 

}


?>
       <!-- Header section -->
<?php include('layouts/header.php');?>


     <!-- Search Section -->   
    <section id="search" class="py-2 my-2 mt-5 ">
      <div class="container mt-5 py-5">
        <p>Search Products</p>
        <hr style="margin-left:0px">
      </div>
    
      <form action="shop.php" method="POST" >
        
        <div class="row mx-auto container">
                     <div class="col-lg-3 col-md-4 col-sm-12"> 
                        <p>Category</p>
                            <div class="form-check">
                             <input type="radio" class="form-check-input" name="category" value="bags" id="category_one" <?php if(isset($category) && $category=='bags'){echo 'checked';} ?> />
                             <label class="form-check-label" for="flexRadioDefault1">
                             Bags
                             </label>
                            </div>
                
                            <div class="form-check">
                             <input type="radio" class="form-check-input" name="category" value="watch" id="category_two" <?php if(isset($category) && $category=='watch'){echo 'checked';} ?>/>
                             <label class="form-check-label" for="flexRadioDefault2"> 
                             Watch
                             </label>
                            </div>
                
                            <div class="form-check">
                            <input type="radio" class="form-check-input" name="category" value="dress" id="category_two" <?php if(isset($category) && $category=='dress'){echo 'checked';} ?>/>
                            <label class="form-check-label" for="flexRadioDefault2"> 
                             Dress
                            </label>
                            </div>
                
                            <div class="form-check">
                            <input type="radio" class="form-check-input" name="category" value="heels" id="category_two" <?php if(isset($category) && $category=='heels'){echo 'checked';} ?>/>
                            <label class="form-check-label" for="flexRadioDefault2"> 
                            Heels
                             </label>
                            </div>
                      </div>
                     </div>    
        
                <div class="row mx-auto conatainer mt-5">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Price</p>
                    <input type="range" class="form-range w-25" name="price" value="<?php if(isset($price)){echo $price;}else{echo '100';} ?>" min="1" max="1000" id="customRange2"/>
                    <div class="w-25">
                    <span style="float:left">1</span>
                    <span style="float:right">1000</span>
                    </div>
                  </div>
                </div>
        
                <div class="form-group my-3 mx-3 justify-content-center">
                  <input type="submit" name="search" value="search" class="btn btn-primary">
                </div>
        </div>
                
      </form>

    </section>
         
        
    <!-- Shop Section -->
    <section id="shop" class="pb-5 my-5">
       <div class="container text-center mt-5 py-5">
         <h3>Our Products</h3>
         <hr>
         <p>Here you can check out our products</p>
       </div>
 
      <div class="row mx-auto container">
        <?php while($row = $products->fetch_assoc()) { ?>
          <div onclick="window.location.href='single_product.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
           <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="img">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
           <h5 class="p-name"><?php echo $row['product_name'];?></h5>
           <h4 class="p-price"><?php echo $row['product_price'];?></h4>
           <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>
         <?php  } ?>
      </div>
 

      <!-- Pagination -->
    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-5">

        <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
        <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo "?page_no=".($page_no-1);}?>">
        Previous
        </a>
        </li>

        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

        <?php if($page_no>=3) {?>
        <li class="page-item"><a class="page-link" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" .$page_no;?>"><?php echo $page_no;?></a></li>
        <?php } ?>

        <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>  ">
        <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);}?>">
          Next
        </a>
        </li>

    </ul>
    </nav>
    </section>  

  
    

    

  

 


   
    
    <!-- Footer section -->
    <?php include('layouts/footer.php');?>