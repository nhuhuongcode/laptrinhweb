<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/giohang.css">
    <link rel="stylesheet" type="text/css" href="./css/chitiet.css">
    <link rel="stylesheet" type="text/css" href="./css/thanhtoan.css">
    <link rel="stylesheet" type="text/css" href="./css/giohangtrong.css">
    <link rel="stylesheet" type="text/css" href="./css/Tracuudonhang.css">
    <link rel="stylesheet" type="text/css" href="./css/sodienthoai.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b15ad03e0d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Nhà của Sím</title>
</head>
<body>
    <div class="wrapper">
        <?php
            include("pages/header.php");
            if(isset($_GET["quanly"])){
                $tam =$_GET["quanly"];
            }else{
                $tam = '';
            }
            if($tam != 'giohang' && $tam !='sanpham' && $tam != 'thanhtoan' && $tam != 'tracuu' && $tam != 'donhang')
            {
                include("pages/menu.php");
            }
            include("pages/main.php");
            include("pages/footer.php");
        ?>
    </div>
</body>
</html>