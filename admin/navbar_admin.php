<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="test/css/styles.css" rel="stylesheet" />
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand text-white" href="#!">KFC Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="#!">หน้าแรก</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="product_admin.php">Product</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="user_admin.php">User</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="order_list.php">Orderlist</a></li>
                    </ul>
                    <div class="d-flex mx-3">
                        <?php
                            session_start();
                            @$name=$_SESSION['name'];
                            if($name!=""){
                        ?>
                        <ul class="navbar-nav">
                            <li class="nav-link">
                                <a class="btn text-white btn-outline-light" href="">
                                    <?php
                                        echo $name;
                                    ?>    
                                </a>
                            </li>
                            <li class="nav-link">
                                <a class="btn btn-outline-light text-white" href="../logout.php">Log out</a>
                            </li>  
                        </ul>
                        <?php }
                        else {?>
                        <a href="login.php" class="btn btn-outline-light text-black">Log in</a>
                        <?php } ?>
                        </div>
                </div>
            </div>
        </nav>