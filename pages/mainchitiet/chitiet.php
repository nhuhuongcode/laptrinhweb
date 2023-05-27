<div id="mainchitiet">
    <div class="bannersale">
        <img  src="imgs/rectangle-4.png" alt="">
    </div>
    <?php
        require_once "./admincp/module/db_module.php";
        $link = null;
        taoKetNoi($link);
        if(isset($_GET['id']))
            $idsach = $_GET['id'];
            $query = "SELECT * FROM tbl_sach INNER JOIN ( tbl_chi_tiet_danh_muc INNER JOIN tbl_danh_muc ON tbl_danh_muc.id_danh_muc = tbl_chi_tiet_danh_muc.id_danh_muc ) 
            ON tbl_sach.id_danh_muc_chi_tiet = tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet 
            INNER JOIN tbl_tac_gia ON tbl_tac_gia.id_tac_gia = tbl_sach.id_tac_gia WHERE tbl_sach.id_sach ='".$idsach."' limit 1 ";

        $result = chayTruyVanTraVeDL($link, $query);
        $row = mysqli_fetch_assoc($result);
        
        $queryhinhanh = "Select link_hinh_anh from tbl_hinh_anh where id_sach = '".$idsach."';";
        
        $resulthinhanh = chayTruyVanTraVeDL($link, $queryhinhanh);
        $rowhinhanh1 = mysqli_fetch_array($resulthinhanh);
        
        $total = mysqli_num_rows($resulthinhanh);
    ?>
    <div class="text">
        <a href="index.php">Trang chủ</a>
        <p>>></p>
        <a href="index.php?quanly=danhmucsanpham&&iddanhmuc=<?php echo $row['id_danh_muc'] ?>&&page=0"><?php echo $row['ten_danh_muc']?></a>
        <p>>></p>
        <a href="#"><?php echo $row['ten_danh_muc_chi_tiet'] ?></a>
        <p>>></p>
        <a href="#"><?php echo $row['ten_tac_gia'] ?></a>
    </div>
    <div class="chitiet">
        <div class="groupimage">
            <div class="image">
                <img  src="<?php echo $rowhinhanh1['link_hinh_anh']?>" alt="">
            </div>
            <div class="ortherimage">
            <?php
            
                while($rowhinhanh = mysqli_fetch_assoc($resulthinhanh))
                {
                    echo" 
                    <img src='".$rowhinhanh['link_hinh_anh']."' alt=''>";
                }
                ?>
            </div>

        </div>
        <div class="line"> </div>
        
        <div class="content">
            <div class="header_ct">
                <div class="tacgia">
                    <p>Tác giả: </p>
                    <a href=""><?php echo $row['ten_tac_gia'] ?></a>
                </div>
                
                <h4 class="title"><?php echo $row['ten_sach'] ?></h4>
            </div>
            <div class="body_ct">
                <div class="price">
                    <h2><?php echo $row['gia'] ?>đ</h2></div>
                <div class="linengang"></div>
                <div class="giaohang">
                    <div class="diachigiaohang1">
                        <p>Giao đến địa chỉ </p></div>
                    <div class="diachigiaohang2">
                        <p>Huyện Bình Chánh, TP.Hồ Chí Minh</p></div>
                    <div class="diachigiaohang3">
                        <p> - </p></div>
                    <div class="diachigiaohang4">
                        <p>Đổi địa chỉ</p></div>
                    </div>
                <div class="phigiaohang">
                        <div class="phigiaohang1">
                            <div class="phigiaohang1a">
                                <p>FAST</P>
                            </div>
                            <div class="phigiaohang1b">
                                <p>Thứ 2, ngày 29/4</p>                                
                             </div>
                        </div>
                        <div class="phigiaohang2">
                            <p>Vận chuyển: 14.000 đ</p>
                        </div>
                </div>
                <div class="soluong_chonmua">
                    <p>Số lượng</p>
                    <div class="soluong">
                        
                        <button class="minus">
                            <i style = "background-color: rgb(204, 204, 204);" ></i>
                        </button>
                        <span class="quantity">1</span>
                        <button class="plus">
                            <i style="background-color: rgb(204, 204, 204);"></i>
                            <i style="background-color: rgb(204, 204, 204);"></i>
                        </button>
                        </div>
                    <div class="chonmua">
                    <form method="POST" action="pages/main/themgiohang.php?idsach=<?php echo $row["id_sach"]?>">
                            <input class='btn btn-success' name='themgiohang' type='submit' value='Chọn mua'>
                    </form>
                    </div>
                </div>
                </div>
            </div>
    </div>
    
    <div class="sanphamtuongtu">
        <h3>Sản phẩm tương tự</h3>
        <?php
        $query = "SELECT *
        FROM (((tbl_sach
        LEFT JOIN (
            SELECT id_sach,link_hinh_anh, MIN(id_hinh_anh) AS id_hinh_anh
            FROM tbl_hinh_anh
            GROUP BY id_sach
        ) AS tbl_hinh_anh ON tbl_sach.id_sach = tbl_hinh_anh.id_sach)
              INNER JOIN tbl_tac_gia on tbl_tac_gia.id_tac_gia = tbl_sach.id_tac_gia)
        INNER JOIN tbl_chi_tiet_danh_muc on tbl_chi_tiet_danh_muc.id_danh_muc_chi_tiet = tbl_sach.id_danh_muc_chi_tiet)
        INNER JOIN tbl_danh_muc on tbl_danh_muc.id_danh_muc = tbl_chi_tiet_danh_muc.id_danh_muc
        WHERE tbl_danh_muc.id_danh_muc ='".$row['id_danh_muc']."' limit 6;" ;
        $resulttuongtu = chayTruyVanTraVeDL($link,$query);
        ?>
        <ul class="sanphamtuongtu_list">
        <div class="icon_left">
            <i class="fa-solid fa-chevron-left fa-xl" ></i></div>
            <?php
            while($rowtuongtu = mysqli_fetch_assoc($resulttuongtu)){
             ?>   
            <li>
                <a href="index.php?quanly=sanpham&id=<?php echo $rowtuongtu['id_sach']?>">
                    <img src="<?php echo $rowtuongtu['link_hinh_anh']?>">
                    <p class="title_product"><?php echo $rowtuongtu['ten_sach']?></p>
                    <p class="author"><?php echo $rowtuongtu['ten_tac_gia']?>
                    <p class="price_product"><?php echo $rowtuongtu['gia']?></p>
                </a>
            </li>
            <?php } ?>
            <div class="icon_right">
                <i class="fa-solid fa-chevron-right fa-xl"></i></div>
        </ul>   
    </div>
    <?php
    if(isset($_GET['id'])){
        $idsach = $_GET['id'];
    
        $querymota = "SELECT tbl_cong_ty_phat_hanh.ten_cong_ty_phat_hanh, tbl_nguoi_phien_dich.ten_phien_dich, tbl_nha_xuat_ban.ten_nha_xuat_ban, tbl_thong_so.ngon_ngu, tbl_thong_so.nam_xuat_ban, tbl_thong_so.loai_bia, tbl_thong_so.kich_thuoc, tbl_thong_so.so_trang
        FROM (((tbl_sach left join tbl_thong_so on tbl_sach.id_sach = tbl_thong_so.id_sach) 
            left JOIN tbl_cong_ty_phat_hanh on tbl_sach.id_cong_ty_phat_hanh = tbl_cong_ty_phat_hanh.id_cong_ty_phat_hanh)
            left JOIN tbl_nha_xuat_ban on tbl_sach.id_nha_xuat_ban = tbl_nha_xuat_ban.id_nha_xuat_ban)
            left JOIN tbl_nguoi_phien_dich on tbl_sach.id_phien_dich = tbl_nguoi_phien_dich.id_phien_dich
            WHERE tbl_sach.id_sach ='".$idsach."';";
    }
        $resultmota = chayTruyVanTraVeDL($link,$querymota);
    ?>
    <div class="thongtin">
        <h3>Thông tin chi tiết</h3>
        <div class="table">
            <table>
            <?php
            
                #$firstRow = true;
                while ($rowmota = mysqli_fetch_assoc($resultmota)) {
                    
                    foreach ($rowmota as $key => $value) {
                        echo "<tr>";
                        $namecol="";
                        if ($value != null) {
                            if($key == "ten_nha_xuat_ban"){
                                $namecol = "Nhà xuất bản";
                            }elseif($key == "ten_cong_ty_phat_hanh"){
                                $namecol ="Công ty phát hành";
                            }elseif($key == "ten_phien_dich"){
                                $namecol ="Dịch giả";
                            }
                            elseif($key == "ngon_ngu"){
                                $namecol ="Ngôn ngữ";
                            }elseif($key == "nam_xuat_ban"){
                                $namecol ="Năm xuất bản";
                            }elseif($key == "loai_bia"){
                                $namecol ="Loại bìa";
                            }elseif($key == "kich_thuoc"){
                                $namecol ="Kích thước";
                            }else{
                                $namecol ="Số trang";
                            }
                            echo "<th>" . $namecol . "</th>";
                            echo "<td>" . $value . "</td>";
                        }
                        echo "</tr>";
                    }
                    
            
                    // if ($firstRow) {
                    //     $firstRow = false;
                    // }
                }      
            ?>
            </table>
        </div>
    </div>
    
    <div class="mota">
        <h3>Mô tả sản phẩm</h3>
        <div class="contentmota">
        <p><?php echo $row['mo_ta'] ?></p></div>
    </div>
</div>
<div class="clear"></div>