<?php
    include '../navbar.php';
    include '../connect.php';
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $filename=$_FILES['user_pic']['name'];
        if($username==""||$password==""||$name==""||$email==""||$filename=="")
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
                    echo "<script>window.location.href='../index.php'</script>";
                    }   
                    }
                }
            }
    }

?> 
<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-danger text-white">เพิ่มข้อมูล User</div>
        <div class="card-body">
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
                <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn bg-danger text-white" name="submit" value="เพิ่มข้อมูล">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>