
<ul class="product_list">
    <?php
        require_once "./admincp/module/db_module.php";
        $link = null;
    
        taoKetNoi($link);
        $from_p = 0;
                if(isset($_GET['page']))
                    $from_p = $_GET['page'];
                $from = NUM_PROD_PER_PAGE * $from_p;
        
                $result = chayTruyVanTraVeDL($link, "select * from tbl_sach,tbl_tac_gia 
                                                        where  tbl_sach.id_tac_gia =tbl_tac_gia.id_tac_gia 
                                                        limit $from, ".NUM_PROD_PER_PAGE);
                while($rows=mysqli_fetch_assoc($result)){
                    
                    $tenSach = $rows['ten_sach'];

                    $maxTitleLength = 23;
                    $ellipsis = '...';
                    $idsach = $rows['id_sach'];

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
            $result = chayTruyVanTraVeDL($link, "select count(*) from tbl_sach");
            $total_r = mysqli_fetch_row($result);
            $total = $total_r[0];
            $pages = ceil($total/NUM_PROD_PER_PAGE);
            for($i=0; $i<$pages; $i++)
                echo"<li class='btn-container' class='page-item'><a class='page-link' href='?page=".$i ."'>".$i."</a></li>";
            
    ?>
</ul>


                                
    