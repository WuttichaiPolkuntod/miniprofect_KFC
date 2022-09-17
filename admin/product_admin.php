<?php
    include 'navbar_admin.php';
    include '../connect.php';
    $sql="SELECT * FROM product";
    $result=$con->query($sql);
    if(isset($_POST['addsubmit'])){
        $pro_name=$_POST['name'];
        $pro_type=$_POST['type'];
        $pro_price=$_POST['price'];
        $amount=$_POST['qty'];
        $details=$_POST['details'];
        $filename=$_FILES['pro_pic']['name'];
        if($pro_name==""||$pro_price==""||$amount==""||$pro_type=="")
        {
            echo "<script>alert('คุณกรอกข้อมูลไม่ครบ')</script>";
        }
            else
            {
                $sql2="SELECT pro_name FROM product WHERE pro_name='$pro_name'";
                $result2=$con->query($sql2);
                $num=mysqli_num_rows($result2);
                if($num==1){
                    echo "<script>alert('มีสินค้านี้มีอยู่แล้ว')</script>";
                }
                else{
                    if(move_uploaded_file($_FILES['pro_pic']['tmp_name'],'product_pic/'.$filename)){
                        $sql="INSERT  INTO product (pro_name,pro_type,details,pro_price,amount,pro_pic) VALUES('$pro_name','$pro_type','$details','$pro_price','$amount','$filename')";
                        $result=$con->query($sql);
                        if(!$result){
                            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                            }
                            else{
                            echo "<script>window.location.href='product_admin.php'</script>";
                            }  
                        }
                        else{
                            $sql="INSERT  INTO product (pro_name,pro_type,details,pro_price,amount) VALUES('$pro_name','$pro_type','$details','$pro_price','$amount')";
                            $result=$con->query($sql);
                            if(!$result){
                                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                                }
                                else{
                                echo "<script>window.location.href='product_admin.php'</script>";
                                }  
                        }
                }
            }
    }
?> 
<div class="container mt-5 w-75">
<div class="row">
    <div class="col-4">
        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#addproduct">
            Add New Product
        </button>
    </div>
</div>
    <table class="table table-striped">
        <tr class="bg-danger">
            <th class="text-white">ลำดับที่</th>
            <th class="text-white">ชื่อสินค้า</th>
            <th class="text-white">ประเภทสินค้า</th>
            <th class="text-white">รายละเอียด</th>
            <th class="text-white">ราคา</th>
            <th class="text-white">จำนวน</th>
            <th class="text-white">รูปภาพ</th>
            <th class="text-white">การจัดการ</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['pro_id'] ?></td>
            <td><?php echo $row['pro_name'] ?></td>
            <td><?php echo $row['pro_type'] ?></td>
            <td><?php echo $row['details'] ?></td>
            <td><?php echo $row['pro_price'] ?></td>
            <td><?php echo $row['amount'] ?></td>
            <td>
                <img src="product_pic/<?php echo $row['pro_pic'] ?>" width="150">
            </td>
            <td>
            <a href="edit_product.php?pro_id=<?php echo $row['pro_id']?>" class="btn bg-warning"><i class="bi bi-pencil-square"></i></a>
                <a href="del_product.php?pro_id=<?php echo $row['pro_id']?>" class="btn bg-danger" onclick=" return confirm('ต้องการลบใช่หรือไม่?')"><i class="bi bi-x-square-fill"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- Addproduct Modal -->
<div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header  bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่มข้อมูล Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">ชื่อสินค้า</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">ประเภทสินค้า</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="type">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">รายละเอียด</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form*control" name="details"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">ราคา</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="price">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">จำนวน</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="qty">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="pro_pic">
                    </div>
                </div>
      <div class="modal-footer">
            <input type="submit" class="btn bg-danger text-white" name="addsubmit" value="เพิ่มข้อมูล">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Addproduct Modal -->