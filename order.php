<?php
session_start();
require 'connect.php';
 
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());
if (isset($_SESSION['qty'])) {
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem) {
        $meQty = $meQty + $meItem;
    }
} else {
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
    } 
    else 
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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script type="text/javascript">
        function updateSubmit() {
            if (document.formupdate.order_fullname.value == "") {
                alert('โปรดใส่ชื่อนามสกุลด้วย!');
                document.formupdate.order_fullname.focus();
                return false;
            }
            if (document.formupdate.order_address.value == "") {
                alert('โปรดใส่ที่อยู่ด้วย!');
                document.formupdate.order_address.focus();
                return false;
            }
            if (document.formupdate.order_phone.value == "") {
                alert('โปรดใส่เบอร์โทรด้วย!');
                document.formupdate.order_phone.focus();
                return false;
            }
            document.formupdate.submit();
            return false;
        }
    </script>
</head>

<body>
    <div class="container">

        <!-- Static navbar -->
        <?php include 'navbar.php'?>
        <h3>รายการสั่งซื้อ</h3>
        <!-- Main component for a primary marketing message or call to action -->
        <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
            }
            
            if ($meCount == 0)
            {
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } 
            else
            {
        ?>

        <form action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate"
            onsubmit="JavaScript:return updateSubmit();">
            <div class="form-group">
                <label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" name="order_fullname">
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">ที่อยู่</label>
                <textarea class="form-control" rows="3" style="width: 500px;" name="order_address" id="order_address"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone">
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>จำนวนเงิน</th>
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
                        <td>
                            <?php echo $meResult['pro_id']; ?>
                        </td>
                        <td>
                            <?php echo $meResult['pro_name']; ?>
                        </td>
                        <td>
                            <?php echo $meResult['details']; ?>
                        </td>
                        <td>
                            <?php echo $_SESSION['qty'][$key]; ?>
                            <input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                            <input type="hidden" name="product_id[]" value="<?php echo $meResult['pro_id']; ?>" />
                            <input type="hidden" name="product_price[]"
                                value="<?php echo $meResult['pro_price']; ?>" />
                        </td>
                        <td>
                            <?php echo number_format($meResult['pro_price'], 2); ?>
                        </td>
                        <td>
                            <?php echo number_format(($meResult['pro_price'] * $_SESSION['qty'][$key]), 2); ?>
                        </td>
                    </tr>
                    <?php
$num++;
}
?>
                    <tr>
                        <td colspan="8" style="text-align: right;">
                            <h4>จำนวนเงินรวมทั้งหมด
                                <?php echo number_format($total_price, 2); ?> บาท
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: right;">
                            <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>" />
                            <a href="cart.php" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-primary btn-lg">บันทึกการสั่งซื้อสินค้า</button>
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