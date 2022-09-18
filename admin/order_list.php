<?php
    session_start();
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
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>order list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <?php 
        include 'navbar_admin.php';
        include '../connect.php';
    ?>

    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">รายการสั่งซื้อของฉัน</div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รหัสสินค้า</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทรศัพท์</th>
                    </tr>
                    <?php
                        $result=$con->query("SELECT * FROM orders");
                        $i=1;
                        while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $i;$i++;?></td>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo date_th($row['order_date'])?></td>
                        <td><?php echo $row['order_fullname']?></td>
                        <td><?php echo $row['order_phone']?></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>