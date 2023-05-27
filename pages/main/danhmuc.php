<?php
require_once "./admincp/module/db_module.php";
$link = null;
taoKetNoi($link);
if(isset($_GET['iddanhmuc']))
    $iddanhmuc1 = $_GET['iddanhmuc'];
    $query1 = "SELECT * FROM tbl_sach INNER JOIN ( tbl_chi_tiet_danh_muc INNER JOIN tbl_danh_muc ON tbl_danh_muc.id_danh_muc = tbl_chi_tiet_danh_muc.id_danh_muc ) 
    ON tbl_sach.id_danh_muc_chi_tiet = tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet 
    INNER JOIN tbl_tac_gia ON tbl_tac_gia.id_tac_gia = tbl_sach.id_tac_gia WHERE tbl_chi_tiet_danh_muc.id_danh_muc ='".$iddanhmuc1."'; ";

$result1 = chayTruyVanTraVeDL($link, $query1);
$row = mysqli_fetch_assoc($result1);
?>
<div class="text">
        <a href="index.php">Trang chủ</a>
        <p>>></p>
        <a href="index.php?quanly=danhmucsanpham&&iddanhmuc=<?php echo $rows['id_danh_muc']?>&&page=0"><?php echo $row["ten_danh_muc"]?></a>
</div>
<ul class="product_list">
    <?php
        require_once "./admincp/module/db_module.php";
        $link = null;
    
        taoKetNoi($link);
        $from_p = 0;
                if(isset($_GET['iddanhmuc']) && isset($_GET['page']))
                    $iddanhmuc = $_GET['iddanhmuc'];
                    $from_p = $_GET['page'];
                    $from = NUM_PROD_PER_PAGE * $from_p;
                    $query = "SELECT * FROM tbl_sach INNER JOIN ( tbl_chi_tiet_danh_muc INNER JOIN tbl_danh_muc ON tbl_danh_muc.id_danh_muc = tbl_chi_tiet_danh_muc.id_danh_muc ) 
                    ON tbl_sach.id_danh_muc_chi_tiet = tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet 
                    INNER JOIN tbl_tac_gia ON tbl_tac_gia.id_tac_gia = tbl_sach.id_tac_gia WHERE tbl_chi_tiet_danh_muc.id_danh_muc ='".$iddanhmuc."' limit ".$from.",".NUM_PROD_PER_PAGE."; ";
        
                $result = chayTruyVanTraVeDL($link, $query);
                while($rows=mysqli_fetch_assoc($result)){
                    
                    $tenSach = $rows['ten_sach'];
                    $idsach = $rows['id_sach'];
                    $maxTitleLength = 23;
                    $ellipsis = '...'; 
                    if (mb_strlen($tenSach, 'UTF-8') > $maxTitleLength) {
                        $shortenedTitle = mb_substr($tenSach, 0, $maxTitleLength, 'UTF-8') . $ellipsis;
                      } else {
                        $shortenedTitle = $tenSach;
                      }
                    $queryhinhanh = "Select link_hinh_anh from tbl_hinh_anh where id_sach = '".$idsach."' Limit 1;";
                    $resulthinhanh = chayTruyVanTraVeDL($link, $queryhinhanh);
                    $rowhinhanh = mysqli_fetch_array($resulthinhanh);
                
                    echo "
                    <li class='btn-container'>
                        <a href='index.php?quanly=sanpham&id=".$rows['id_sach']."'>
                            <img src='".$rowhinhanh['link_hinh_anh']."'>
                            <p class='title_product'>".$shortenedTitle."</p>
                            <p class='title_author'>Tác giả: ".$rows['ten_tac_gia']."</p>
                            <p class='price_product'>".number_format($rows['gia'])."đ</p>
                        </a>
                    
                        <form method='POST' action='pages/main/themgiohang.php?idsach=".$rows['id_sach']."'>
                            <input class='btn btn-success' name='themgiohang' type='submit' value='Chọn mua'>
                        </form>
                    </li> 
                    ";
                }
    ?>
    
</ul>

<div class="clear"></div>
<ul class="pagination">
    <?php
           $query2 = "SELECT COUNT(*) AS total_count FROM ( SELECT tbl_sach.id_sach, tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet, tbl_danh_muc.id_danh_muc, tbl_tac_gia.id_tac_gia FROM tbl_sach 
           INNER JOIN tbl_chi_tiet_danh_muc ON tbl_sach.id_danh_muc_chi_tiet = tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet 
           INNER JOIN tbl_danh_muc ON tbl_danh_muc.id_danh_muc = tbl_chi_tiet_danh_muc.id_danh_muc 
           INNER JOIN tbl_tac_gia ON tbl_tac_gia.id_tac_gia = tbl_sach.id_tac_gia 
           WHERE tbl_chi_tiet_danh_muc.id_danh_muc ='".$iddanhmuc."' ) AS subquery;";
            $result = chayTruyVanTraVeDL($link, $query2);
            $total_r = mysqli_fetch_row($result);
            $total = $total_r[0];
            $pages = ceil($total/NUM_PROD_PER_PAGE);
            for($i = 0; $i < $pages; $i++) {
            echo "<li class='btn-container page-item'><a class='page-link' href='index.php?quanly=danhmucsanpham&&iddanhmuc=".$iddanhmuc."&&page=".$i."'>".$i."</a></li>";
            }
    ?>
</ul>