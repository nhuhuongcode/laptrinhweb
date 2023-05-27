<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'\www\admincp\module\db_module.php');
$link = null;

taoKetNoi($link);
if($_POST['id_tinh']){
    $query = "select * from tbl_huyen where cap_tren = '".$_POST['id_tinh']."';";
    $resulthuyen = chayTruyVanTraVeDL($link,$query);

?>
<option value="">Chọn Quận/Huyện</option>
<?php
while($rowhuyen =mysqli_fetch_assoc($resulthuyen)){
    echo"
    <option value='".$rowhuyen['id_huyen']."' >".$rowhuyen['ten_huyen']."</option>";
    
    }
}elseif ($_POST['id_huyen']){
    $query = "select * from tbl_xa where cap_tren = '".$_POST['id_huyen']."';";
    $resulxa = chayTruyVanTraVeDL($link,$query);
 echo   "<option value=''>Chọn Xã/Huyện</option>";
while($rowxa =mysqli_fetch_assoc($resulxa)){
    echo"
    <option value='".$rowxa['id_xa']."' >".$rowxa['ten_xa']."</option>";
    
    }
}
?>