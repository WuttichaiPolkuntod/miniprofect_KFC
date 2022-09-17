<?php
    include '../navbar.php';
    include '../connect.php';
    $sql="SELECT * FROM user";
    $result=$con->query($sql);
?> 
<div class="container mt-5 w-75">
<div class="row">
        <div class="col-4">
            <a href="add_User.php" class="btn btn-danger mb-3">+เพิ่มข้อมูล</a>
        </div>
        <div class="col-8">
            <form action="user_uploadcsv.php" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-3">
                    <label for="" class="">อัพโหลดโหลดไฟล์</label>
                </div>
                <div class="col-5">
                    <input type="file" class="form-control" class="mb-3" name="csv_file">
                </div>
                <div class="col-4">
                    <input type="submit" name="addm" class="btn btn-danger mb-3" value="+เพิ่มข้อมูลที่ละหลายคน">
                </div>
            </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <tr class="bg-danger">
            <th class="text-white" >ลำดับที่</th>
            <th class="text-white">ชื่อ - นามสกุล</th>
            <th class="text-white">username</th>
            <th class="text-white">email</th>
            <th class="text-white">รูปภาพ</th>
            <th class="text-white">การจัดการ</th>
        </tr>
        <?php
            $counter=1;
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $counter;$counter++; ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td>
                <img src="user_pic/<?php echo $row['user_pic'] ?>" width="150">
            </td>
            <td>
                <a href="edit_user.php?username=<?php echo $row['username']?>" class="btn bg-warning"><i class="bi bi-pencil-square"></i></a>
                <a href="del_user.php?username=<?php echo $row['username']?>" class="btn bg-danger" onclick=" return confirm('ยืนยันการลบไหม')"><i class="bi bi-x-square-fill"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>