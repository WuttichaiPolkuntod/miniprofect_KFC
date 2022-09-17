<?php
    session_start();
    require 'connect.php';
    $meSql = "SELECT * FROM product";
    $meQuery = $con->query($meSql);

    $action = isset($_GET['a']) ? $_GET['a'] : "";
    $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    if(isset($_SESSION['qty']))
    {
        $meQty = 0;
        foreach($_SESSION['qty'] as $meItem){
        $meQty = $meQty + $meItem;
        }
    }
    else
    {
        $meQty=0;
    }
    include 'navbar.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="fav.png">
    <title>shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
  <body>
  <header class="bg-danger py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">KFC Shop</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The best chicken in the town.</p>
                </div>
            </div>
    </header>
    <?php
        if($action == 'exists'){
            echo "<div class=\"alert alert-warning\">เพิ่มจำนวนสินค้าแล้ว</div>";
        }
            if($action == 'add'){
            echo "<div class=\"alert alert-success\">เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
        }
            if($action == 'order'){
            echo "<div class=\"alert alert-success\">สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
        }
            if($action == 'orderfail'){
            echo "<div class=\"alert alert-warning\">สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
        }
    ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            while ($meResult = mysqli_fetch_assoc($meQuery))
            {
            ?>
                <div class="col mb-5">
                    <div class="card h-100 bg-danger">
                        <!-- Product image-->
                        <img src="admin/product_pic/<?php echo $meResult['pro_pic']; ?>" width="268" height="268">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center text-white">
                                <!-- Product name-->
                                <h5 class="fw-bolder text-white"><?php echo $meResult['pro_name'] ?></h5>
                                <!-- Product price-->
                                <?php echo $meResult['pro_price'] ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                        <a class="btn btn-outline-Light mt-auto text-white" href="updatecart.php?itemId=<?php echo $meResult['pro_id']; ?>" role="button">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        add to cart</a>
                        </div>
                    </div>
                </div>
            <?php } ?>               
            </div>
        </div> 
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>