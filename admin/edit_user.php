<?php
    require_once 'navbar_admin.php';
    require_once '../connect.php';
    $username=$_GET['username'];
    $sql="SELECT * FROM user WHERE username='$username'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);
    if(isset($_POST['submit'])){
        $password=$_POST['password'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $filename=$_FILES['user_pic']['name'];
        if(isset($filename)){
            @unlink('user_pic/'.$row['user_pic']);
            move_uploaded_file($_FILES['user_pic']['tmp_name'],'user_pic/'.$filename);
            $sql="UPDATE user SET password='$password',name='$name',email='$email',user_pic='$filename' WHERE username='$username'";
        }
        else{
            $sql="UPDATE user SET password='$password',name='$name',email='$email' WHERE username='$username'";
        }
        $result=$con->query($sql);
        if(!$result){
            echo"<script>alert('ไม่สามารถบันทึกข้อมูลได้')</script>";
        }
        else{
            echo "<script>window.location.href='user_admin.php'</script>";
        }
    }
?> 

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">แก้ไขข้อมูล User</div>
        <div class="card-body">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="username" readonly value="<?php echo $row['username']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form*control" name="password" value="<?php echo $row['password']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form*control" name="name" value="<?php echo $row['name']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form*control" name="email" value="<?php echo $row['email']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-10">
                        <img src="user_pic/<?php echo $row['user_pic']?>" width="150px">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="user_pic">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn bg-success text-white" name="submit" value="บันทึกข้อมูล">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>