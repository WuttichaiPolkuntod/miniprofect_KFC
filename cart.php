<?php
session_start();
require 'connect.php';
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
$meQty = 0;
foreach ($_SESSION['qty'] as $meItem)
{
$meQty = $meQty + $meItem;
}
} else
{
$meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
$itemIds = "";
foreach ($_SESSION['cart'] as $itemId)
{
$itemIds = $itemIds . $itemId . ",";
}
$inputItems = rtrim($itemIds, ",");
$meSql = "SELECT * FROM product WHERE pro_id in ({$inputItems})";
$meQuery = $con->query($meSql);
$meCount = mysqli_num_rows($meQuery);
} else
{
$meCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itoffside.com shopping cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <h3>ตะกร้าสินค้าของฉัน</h3>
        <!-- Main component for a primary marketing message or call to action -->
        <?php
        if ($action == 'removed')
        {
        echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
        }
        
        if ($meCount == 0){
        echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
        } 
        else{
        ?>
        <form action="updatecart.php" method="post" name="fromupdate">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนเงิน</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $total_price = 0;
                $num = 0;
                while ($meResult = mysqli_fetch_assoc($meQuery))
                {
                $key = array_search($meResult['pro_id'], $_SESSION['cart']);
                $total_price = $total_price + ($meResult['pro_price'] * $_SESSION['qty'][$key]);
            ?>
            <tr>
                <td><img src="admin/product_pic/<?php echo $meResult['pro_pic']; ?>" border="0" width="268" height="175"></td>
                <td><?php echo $meResult['pro_id']; ?></td>
                <td><?php echo $meResult['pro_name']; ?></td>
                <td><?php echo $meResult['details']; ?></td>
                <td>
                    <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                    <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                </td>
                <td><?php echo number_format($meResult['pro_price'],2); ?></td>
                <td><?php echo number_format(($meResult['pro_price'] * $_SESSION['qty'][$key]),2); ?></td>
                <td>
                    <a class="btn btn-danger btn-lg" href="removecart.php?itemId=<?php echo $meResult['pro_id']; ?>" role="button">
                    <span class="glyphicon glyphicon-trash"></span>
                    ลบทิ้ง</a>
                </td>
            </tr>
            <?php
                $num++;
                }
            ?>
            <tr>
                <td colspan="8" style="text-align: right;">
                <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price,2); ?> บาท</h4>
                </td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;">
                <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                <a href="order.php" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
        <?php
        }
        ?>
        
    </div> <!-- /container -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
