<?php session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/www/admincp/module/db_module.php';
    $link = null;
    taoKetNoi($link);
    

    if(($_SESSION['cart'])&&$_GET['xoa']){
        $idsach = $_GET['xoa'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['idsach'] != $idsach)
            {
                $product[] = array('ten_sach'=>$cart_itemws['ten_sach'],'idsach'=>$cart_item['idsach'], 'ten_tac_gia' =>$cart_item['ten_tac_gia'], 'gia'=>$cart_item['gia'], 'link_hinh_anh'=>$cart_item['link_hinh_anh'], 'soluong'=>$soluong+1);
            }
            $_SESSION['cart'] = $product;
            header('Location:../../index.php?quanly=giohang');
        }
    }

    if(isset($_POST['themgiohang'])){
        $soluong = 1;
        $idsach = $_GET['idsach'];
        $query = "select * from (tbl_sach INNER JOIN tbl_tac_gia on tbl_sach.id_tac_gia = tbl_tac_gia.id_tac_gia)
        inner JOIN tbl_hinh_anh on tbl_sach.id_sach = tbl_hinh_anh.id_sach
        where tbl_sach.id_sach ='".$idsach."' limit 1;";
        $result = chayTruyVanTraVeDL($link,$query);
        $rows = mysqli_fetch_array($result);
        if($rows){
            $newproduct = array(array('ten_sach'=>$rows['ten_sach'],'idsach'=>$idsach, 'ten_tac_gia' =>$rows['ten_tac_gia'], 'gia'=>$rows['gia'], 'link_hinh_anh'=>$rows['link_hinh_anh'], 'soluong'=>$soluong));
            if(isset($_SESSION['cart'])){
                $found = false;
                foreach($_SESSION['cart'] as $cart_item){
                    if($cart_item['idsach'] == $idsach){
                        $product[] = array('ten_sach'=>$cart_item['ten_sach'],'idsach'=>$cart_item['idsach'], 'ten_tac_gia' =>$cart_item['ten_tac_gia'], 'gia'=>$cart_item['gia'], 'link_hinh_anh'=>$cart_item['link_hinh_anh'], 'soluong'=>$soluong+1);
                        $found == true;
                    }else{
                        $product[] = array('ten_sach'=>$cart_item['ten_sach'],'idsach'=>$cart_item['idsach'], 'ten_tac_gia' =>$cart_item['ten_tac_gia'], 'gia'=>$cart_item['gia'], 'link_hinh_anh'=>$cart_item['link_hinh_anh'], 'soluong'=>$soluong);
                    }
                }
                if($found == false){
                    $_SESSION['cart'] = array_merge($product,$newproduct);
                }else{
                    $_SESSION['cart'] = $product;
                }
            }
            else{
                $_SESSION['cart'] = $newproduct;
            }
        }
        header('Location:../../index.php?quanly=giohang');
    
    
    }

?>