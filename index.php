<?php
    require_once("function/product.php");
    $newest_products = newest_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
    <?php include_once("html/style.php");?>
</head>
<body>
    <header>
    </header>
    <?php include_once("html/nav.php");?>
    <section class="main">
        <div class="container">
            <h2>Newest Products</h2>
            <div class="row">
                <?php foreach($newest_products as $item):?>
                    <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php  ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container">
            <h2>Best Seller</h2>
        </div>
        <div class="container">
            <h2>Hot Items</h2>
        </div>
    </section>
</body>
</html>