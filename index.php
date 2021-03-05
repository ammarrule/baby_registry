<?php 

include 'config.php';

// QUERIES

// Unpurchased Products
$query_unpurchased = "SELECT * FROM products WHERE purchased = 0";
$products_unpurchased = mysqli_query($mysqli, $query_unpurchased);

// Purchased Products
$query_purchased = "SELECT * FROM products WHERE purchased = 1";
$products_purchased = mysqli_query($mysqli, $query_purchased);

if($_POST){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $id = $_POST['id'];

    $query_post = "UPDATE products SET first_name = '$first_name', last_name = '$last_name', purchased = 1 WHERE id = '$id'";
    $update = mysqli_query($mysqli, $query_post);

    header("Location: https://babyregistry.ammarhanif.dev/index.php?msg=1");

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts --> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Butterfly+Kids&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Custom Stylesheet --> 
    <link rel="stylesheet" href="styles/custom.css">

    <!-- favicon -->
    <link rel="shortcut icon" type="image" href="images/favicon.png"/>

    <title>Baby Hanif Registry</title>
  </head>
  <body>

    <div class="container-fluid">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img class="logo" src="images/logo.png">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#welcome">Welcome</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#registry">Registry</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav><!-- navbar -->

      <div class="container">
      
      <?php 
      if (isset($_GET['msg'])) {?>
        <div class="alert alert-success" role="alert">
          Thank you! Your product has been marked as purchased! If you made a mistake, please contact us at dossermelanie@gmail.com.
        </div>
      <? }
      ?>

        
      
        <section id="welcome" class="welcome">
          <h1>Welcome</h1>
          <p>Hello family and friends! We are so happy and grateful that you made it here! Please feel free to check out the registry below. Remember to check the "Purchased" checkbox once you have purchased an item! Note: We are happy to receive used items as well!</p>
        </section><!-- welcome -->

        <section id="registry" class="registry">
          <h1>Registry</h1>
          <p class="mb-5">Please feel free to browse through the items on the registry. Some items have specific links to purchase, but for most feel free to shop around wherever you please. Make sure to return to the registry to check off the "Purchased" box for your item and send us your details, once an item has been purchased! For our mailing address, please check the <a href="#contact">"Contact"</a> section!</p>
          <h3>Available Items</h3>
          <div class="row mb-5 available">
            <?php 
            
            while($row = mysqli_fetch_array($products_unpurchased)){ 
            
              $link = $row['product_link'];
              
            ?>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-5">
              <div class="product-wrapper">
                <img src="images/<?php echo $row['product_image']; ?>"/>
                <p class="product-title"><?php echo $row['product_name']; ?></p>
                <p class="product-description"><? echo $row['product_description']; ?></p>
                
                <?php 
                
                  if($link){ ?>
                    <a target="_blank" href="<?php echo $row['product_link']; ?>" class="buy-here btn btn-primary mt-3 mb-3">Buy Here</a>
                  <? } else { ?>
                    <a target="_blank" href="https://www.google.ca/" class="buy-here btn btn-primary mt-3 mb-3">Buy Anywhere</a>
                  <? } 
                
                ?>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                    Purchased
                  </label>
                </div>
                <form method="POST">
                  <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                  <div class="mb-3">
                      <label for="first_name" class="form-label">First Name</label>
                      <input name="first_name" type="text" class="form-control" id="" placeholder="Your First Name">
                  </div>
                  <div class="mb-3">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input name="last_name" type="text" class="form-control" id="" placeholder="Your Last Name">
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
              </div><!-- product wrapper -->
            </div><!-- col -->

            <? }
            
            ?> 
          </div><!-- row -->

          <h3>Purchased Items</h3>
          <div class="row mb-5 purchased">
            <?php while($row = mysqli_fetch_array($products_purchased)){ ?>

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-5">
              <div class="product-wrapper">
                <img src="images/<? echo $row['product_image']; ?>"/>
                <p class="product-title"><? echo $row['product_name']; ?></p>
                <p class="product-description"><? echo $row['product_description']; ?></p>
              </div>
            </div><!-- col --> 

            <? } ?>
          </div><!-- row -->
        </section><!-- registry -->

        <section id="contact" class="contact mb-5">
          <h1>Contact</h1>
          <p>Our mailing address is: <span style="font-family: Arial; font-size: 1.5rem;"><br/> 1355 Treeland Street, <br/> Burlington, <br/> L7R 4P4</span> </p>
          <p>Made a mistake? Have a question? Contact us at dossermelanie@gmail.com.</p>
        </section>
      
      </div><!--- container -->
    
    </div><!-- container fluid -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->

    <!-- JQuery --> 
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Custom JS --> 
    <script src="scripts/custom.js"></script>

    <script>

        $( document ).ready(function() {
            // console.log( "ready!" );
            $('form').hide();
            $('.form-check-input').click(function(){
              if($(this).is(":checked")){
                $(this).closest('.product-wrapper').children('form').show();
                // $('form').show();
              } else {
                $(this).closest('.product-wrapper').children('form').hide();
                // $('form').hide();
              }
            });

        });

    </script>


  </body>
</html>