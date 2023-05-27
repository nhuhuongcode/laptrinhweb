<div class = list_author>

    <h3>Tác giả</h3>

    <?php
    require_once "./admincp/module/db_module.php";
    $link = null;
    taoKetNoi($link);
    $sql_lietke_tacgia = "SELECT * FROM tbl_tac_gia LIMIT 15";
    $result = chayTruyVanTraVeDL($link, $sql_lietke_tacgia);
    $i =1;
    while($rows=mysqli_fetch_assoc($result)){
        $class = ($i > 5) ? "hidden" : "";
        echo "<div class='form-check'>";
        echo "<input class='form-check-input' type='checkbox' value='' id='checkbox'".$i."".$class."'>";
        echo "<label class='form-check-label' for='checkbox".$i."'>";
        echo    $rows["ten_tac_gia"];
        echo "</label>";
        echo "</div>";
        $i++;
    }
    ?>

    <!-- <button id="btn-show-more" class="btn btn-primary mt-2">Xem thêm</button>
    <button id="btn-show-less" class="btn btn-primary mt-2 hidden">Thu gọn</button> -->
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        var totalItems = <?php echo 15; ?>;
        var visibleItems = <?php echo 5; ?>;
        var btnShowMore = $('.list_author #btn-show-more');
        var btnShowLess = $('.list_autor #btn-show-less');
        btnShowLess.hide();
        btnShowMore.click(function () {
            //$('input[type="checkbox"]:gt(' + (visibleItems - 1) + ')').removeClass('hidden');
            btnShowMore.hide();
            btnShowLess.show();
        });

        btnShowLess.click(function () {
            $('input[type="checkbox"]:gt(' + (visibleItems - 1) + ')').addClass('hidden');
            btnShowMore.removeClass('hidden');
            btnShowLess.addClass('hidden');
        });
    });
</script> -->
