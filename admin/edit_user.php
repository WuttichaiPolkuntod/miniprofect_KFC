<?php
    require_once 'navbar_admin.php';
    require_once '../connect.php';
    $username=$_POST['username'];
    $sql="SELECT * FROM user WHERE username='$username'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);
    if(isset($_POST['editsubmit'])){
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
