<h3>Danh mục sách</h3>
<ul class="list_category">
    <?php
    require_once "./admincp/module/db_module.php";
    $link = null;

    taoKetNoi($link);
    $sql_lietke_danhmuc = "select * from tbl_danh_muc";
    $result = chayTruyVanTraVeDL($link,$sql_lietke_danhmuc);
    while($rows=mysqli_fetch_assoc($result)){
        echo "<li class='category-item'><a href='index.php?quanly=danhmucsanpham&&iddanhmuc=".$rows['id_danh_muc']."&&page=0'>".$rows['ten_danh_muc']."</a></li>";
    }
    ?>
    
</ul>