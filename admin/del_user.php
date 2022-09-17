<?php
    include 'navbar_admin.php';
    include '../connect.php';
    $username=$_GET['username'];
    $sql="SELECT * FROM user WHERE username='$username'";
    $result=$con->query($sql);
    $row=mysqli_fetch_array($result);
    @unlink('user_pic/'.$row['user_pic']);
    $sql="DELETE FROM user WHERE username='$username'";
    $result=$con->query($sql);
    if(!$result){
        echo"<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
    }
    else{
        echo "<script>window.location.href='user_admin.php'</script>";
    }
?> 