<div class="list_company">
    <h3>Công ty phát hành</h3>
    <?php
    require_once "./admincp/module/db_module.php";
    $link = null;

    taoKetNoi($link);
    $sql_lietke_danhmuc = "select * from tbl_cong_ty_phat_hanh limit 15";
    $result = chayTruyVanTraVeDL($link,$sql_lietke_danhmuc);
    $i =1;
    while($rows=mysqli_fetch_assoc($result)){
        $class = ($i > 5) ? "hidden" : "";
        echo "<div class='form-check'>";
        echo "<input class='form-check-input' type='checkbox' value='' id='checkbox'".$i."".$class."'>";
        echo "<label class='form-check-label' for='checkbox".$i."'>";
        echo    $rows["ten_cong_ty_phat_hanh"];
        echo "</label>";
        echo "</div>";
        $i++;
    }
    ?>
</div>