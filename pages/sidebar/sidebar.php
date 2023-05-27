<div class="sidebar">
    <?php
        include("./admincp/module/quanlydanhmuc/lietke.php");
        include("./admincp/module/quanlycongty/lietke.php");
    ?>

    
    
    <div class="list_language" id="lg">
        <h3>Ngôn ngữ sách</h3>
        <div class='ngonngu'>
            <form action="" method="POST">
                <input class='form-check-input' name="ngonngu" type='radio' value='' id='lg-vn'>
                <label class='form-check-label' for='lg-vn'>Tiếng Việt</label>
                <br>
                <input class='form-check-input' name="ngonngu" type='radio' value='' id='lg-en'>
                <label class='form-check-label' for='lg-en'>Tiếng Anh</label>
            </form>  
        </div>
    </div>
    <?php
        include("./admincp/module/quanlytacgia/lietke.php")
    ?>
    
</div>
