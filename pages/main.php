
        <?php
            if(isset($_GET["quanly"])){
                $tam =$_GET["quanly"];
            }else{
                $tam = '';
            }
            if($tam != 'giohang' && $tam != 'sanpham' && $tam != 'thanhtoan' && $tam != 'tracuu' && $tam != 'donhang' )
            {
                echo
                "<div id='main'>";
                include("sidebar/sidebar.php");
                echo
                "<div class='maincontent'>";
                if($tam == 'danhmucsanpham'){
                    include("main/danhmuc.php");}
                elseif($tam == 'timkiem'){
                    include("main/timkiem.php");
                }else{
                    include("main/index.php");
                }
                echo "</div></div>";
            }
            if($tam =="giohang"){
                include("maingiohang/giohang.php");
            }elseif($tam == 'sanpham'){
                include("mainchitiet/chitiet.php");
            }elseif($tam == 'thanhtoan'){
                include("mainthanhtoan/thanhtoan.php");
            }elseif($tam == 'tracuu'){
                include("maintracuu/tracuu.php");
            }elseif($tam == 'donhang'){
                include("maintracuu/donhang.php");}
            

        ?>    
            
