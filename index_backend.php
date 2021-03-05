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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Custom Stylesheet --> 
    <link rel="stylesheet" href="styles/custom.css">

    <title>Hanif Baby Registry</title>
  </head>
  <body>

    <h1>Baby Registry</h1>

    <h3>Unpurchased</h3>

    <?php 

        while($row = mysqli_fetch_array($products_unpurchased)){ ?>
             <p><? echo $row['product_name']; ?></p>
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
       <? };

    ?>


    <h3>Purchased</h3>

    <?php 

        while($row = mysqli_fetch_array($products_purchased)){ ?>
             <p><? echo $row['product_name']; ?></p>
       <? };

    ?>


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


  </body>
</html>