<?php
if(isset($_SESSION['cart'])){
    $i = 0;
    foreach($_SESSION['cart'] as $cart_item){
        $i++;
    }
    $countcart = $i;
}else{
    $countcart = 0;
    }
    ?>
<div class="header">
    <div class="container">
        <a href="index.php" class="header_logo">
            <img src="./imgs/logo.png">
        </a>
        <form action="index.php?quanly=timkiem&&page=0" method="POST" class="form_search">
            <div class="form-group">
                <input type="text" class="input_search" name="keyword" placeholder="Tìm kiếm sản phẩm..." />
            </div>
            <button type="submit" class="btn btn-primary" data-toggle="tooltip"  title="Search"></button>
        </form>
        <div class="clear"></div>

        <div class="trangchu">
            <a href="index.php" class="header_home">
                <button class="btn-trangchu">
                    <span> <i class="fa-regular fa-house" style="color: #ffffff; margin-right: 3px;"></i> </span>
                    Trang chủ
                </button>
            </a>
        </div>
        <div class="giohang">
            <a href="index.php?quanly=giohang" class="header_cart">
                <button class="btn-giohang">
                
                    
                    <span><i class="fa-regular fa-cart-shopping" style="color: #ffffff; margin-right: 3px;"></i></span>
                    Giỏ hàng

                    <span class="cart-number"><?php echo $countcart ?></span>
                </button>
            </a>  
        </div>
        <div class="tracuu">
        <a href="index.php?quanly=tracuu" class="header_history">
            <button class="btn-tracuu">
                <span><i class="fa-regular fa-book" style="color: #ffffff; margin-right: 3px;"></i></span>
                Tra cứu đơn hàng
            </button>
        </a>
        </div>
        
    </div>
</div>