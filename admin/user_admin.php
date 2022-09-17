<?php
    include 'navbar_admin.php';
    include '../connect.php';
    $sql="SELECT * FROM user";
    $result=$con->query($sql);
    # Adduser
    if(isset($_POST['addsubmit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $filename=$_FILES['user_pic']['name'];
        if($username==""||$password==""||$name==""||$email=="")
        {
            echo "<script>alert('คุณกรอกข้อมูลไม่ครบ')</script>";
        }
            else
            {
                $sql2="SELECT username FROM user WHERE username='$username'";
                $result2=$con->query($sql2);
                $num=mysqli_num_rows($result2);
                if($num==1){
                    echo "<script>alert('Username นี้มีอยู่แล้ว')</script>";
                }
                else{
                    if(move_uploaded_file($_FILES['user_pic']['tmp_name'],'user_pic/'.$filename)){

                    $sql="INSERT  INTO user (username,password,name,email,user_pic) VALUES('$username','$password','$name','$email','$filename')";
                    $result=$con->query($sql);
                    if(!$result){
                    echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                    }
                    else{
                    echo "<script>window.location.href='user_admin.php'</script>";
                    }   
                    }
                    else{
                        $sql="INSERT  INTO user (username,password,name,email) VALUES('$username','$password','$name','$email')";
                        $result=$con->query($sql);
                        if(!$result){
                        echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้')</script>";
                        }
                        else{
                        echo "<script>window.location.href='user_admin.php'</script>";
                        }   
                    }
                }
            }
    }
    # Adduser
?> 
<div class="container mt-5 w-75">
<div class="row">
        <div class="col-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#adduser">
            Add User
            </button>
        </div>
    </div>
    <table class="table table-striped">
        <tr class="bg-danger">
            <th class="text-white">ลำดับที่</th>
            <th class="text-white">ชื่อ - นามสกุล</th>
            <th class="text-white">Username</th>
            <th class="text-white">E-mail</th>
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
                <a href="edit_user.php?username=<?php echo $row['username']?>" class="btn bg-warning "><i class="bi bi-pencil-square"></i></a>
                <a href="del_user.php?username=<?php echo $row['username']?>" class="btn bg-danger" onclick=" return confirm('ยืนยันการลบ ?')"><i class="bi bi-x-square-fill"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- AddUser Modal -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header  bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่มข้อมูล User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form*control" name="password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form*control" name="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="user_pic">
                    </div>
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
<!-- AddUser Modal -->