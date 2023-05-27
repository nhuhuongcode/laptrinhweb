<?php
require_once "./admincp/module/db_module.php";
$link = null;

taoKetNoi($link);
?>
<?php
    if(isset($_SESSION['cart'])){
        $i = 0;
        $tongtien = 0;
?>

<?php
    if(isset($_POST['thanhtoan'])){
        $name = $_POST['name'];
        $gioitinh = $_POST['gender'];
        $idkhachhang =$_POST['sdt'];
        $idtinh = $_POST['id_tinh'];
        $idhuyen = $_POST['id_huyen'];
        $idxa = $_POST['id_xa'];
        $diachicuthe = $_POST['diachicuthe'];

        $insertkh = "Insert Into Khach_Hang values (".$idkhachhang.", '".$name."',".$gioitinh.",'".$diachicuthe."',".$idxa.",".$idhuyen.",".$idtinh.");";
        $resultinsert = chayTruyVanKhongTraVeDL($link,$insertkh);

    }
?>
<div id="maingiohang">
    <div class="container">
            <label></label>
        <div class="topcontent">
            <a href="index.php" class="returngiohang">
                <i class="fa-solid fa-chevron-left"></i>
                    Trở về
            </a>
        </div>
        <section> 
            <div class="content">
                <ul class="list">
<?php foreach($_SESSION['cart'] as $cart_item){
            $thanhtien =$cart_item['soluong']*$cart_item['gia'];
            $tongtien +=$thanhtien;
            $i++;
        
?>
                    <li class="sanpham">
                        <div class="hinhanhsp">
                            <a href="index.php?quanly=sanpham&&id=<?php echo $cart_item['idsach']?>">
                            <img src="<?php echo $cart_item['link_hinh_anh']?>" alt=""
                            loading="lazy" class=" ls-is-cached lazyloaded">
                            </a>
                            
                            <div class="delete">
                                <a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['idsach']?>">
                                    <button>
                                        <span> <i class="fa-solid fa-trash" style="color: #9da1aa;"></i> </span>
                                        Xóa
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="inforsp">
                        <label></label>
                        <div class="tensach-gia">
                                <div class="tensach">
                                    <a href="index.php?quanly=sanpham&&id=<?php echo $cart_item['idsach']?>"><?php echo $cart_item['ten_sach']?></a>
                                </div>
                                <div class="gia"><?php echo $cart_item['gia']?>đ</div>
                            </div>

                            <div class="tacgia-soluong">
                                <div class="tacgia">
                                    Tác giả: <?php echo $cart_item['ten_tac_gia']?>
                                </div>
                                <div class="soluong">
                                    <div class="minus">
                                        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['idsach']?>">
                                            <i style = "background-color: rgb(204, 204, 204);" ></i>
                                            <input type="hidden">
                                        </a>
                                    </div>

                                    <input type="text" maxlength="3" class="number" placeholder="<?php echo $cart_item['soluong']?>" style="border: none; pointer-events: all;">

                                    <div class="plus">
                                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['idsach']?>">
                                            <i style="background-color: rgb(204, 204, 204);"></i>
                                            <i style="background-color: rgb(204, 204, 204);"></i>
                                            <input type="hidden">
                                        </a>
                                    </div>

                                    

                                </div>
                            </div>

                        </div>
                    </li>
                    
                <?php
                    }
                    ?>
                </ul>
                <ul class="tamtinh">
                <span><span>Tạm tính</span> (<?php echo $i?> sản phẩm):</span>
                <span><?php echo $tongtien?>đ</span>
                </ul>
                <form class="formkhachhang" action="" method="Post">
                <div class="khachhang">
                    <h4>Thông tin khách hàng</h4>
                    
                        <div class="gioitinh">
                            <span><input name="gender" type="radio" value="1" /> Anh</span>
                            <span><input name="gender" type="radio" value="0" /> Chị</span>
                        </div>

                        <div class="thongtin">
                            <div class="hoten">
                            <input placeholder="Họ và Tên" maxlength="50" id="name" name="name" required>
                            </div>

                            <div class="sdt">
                            <input type="tel" pattern="[0-9]{10}" placeholder="Số điện thoại" maxlength="10" id="sdt" name="sdt" required>
                            </div>
                        </div>
                    
                </div>

                <div class="diachi">
                    <h4>Địa chỉ nhận hàng</h4>
                    <div class="chitietdiachi">
                        <div>
                            <form class="active">
                                <p> Chọn địa chỉ để biết thời gian nhận hàng và phí vận chuyển (nếu có) </p>
                            </form>

                            <div class="chondiachi">
                                <div class="btn-click TP">
                                <select name="tinh" id="tinh" onchange="Fetchhuyen(this.value)" required>
                                    <option >Chọn Tỉnh/Thành phố</option>
                                        <?php
                                        $sql_tinh = "select * from tbl_tinh order by ten_tinh asc;";
                                        $resulttinh = chayTruyVanTraVeDL($link,$sql_tinh);
                                        while($row=mysqli_fetch_assoc($resulttinh)){
                                            echo"
                                                <option value='".$row['id_tinh']."' >".$row['ten_tinh']."</option>";
                                      
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="btn-click QH">
                                    <select name="huyen" id="huyen" onchange="Fetchxa(this.value)" required>
                                        <option>Chọn Quận/Huyện</option>
                                    </select>

                                </div>

                                <div class="btn-click PX">
                                    <select name="xa" id="xa">
                                        <option>Chọn Xã/Phường</option>
                                    </select>
                                </div>

                                <div class="duong">
                                <input placeholder="Số nhà, Tên đường" name="diachicuthe" type="text" required>
                                </div>
                                </form>
                                <div class="select" style="display: none;">
                                    <div class="list" style="position: relative; overflow-y: hidden;">
                                    <aside></aside>
                                    <aside></aside>
                                        <div class="resize trigger">
                                            <div class="expand-trigger"><div style="width: 281px; height: 1px;"></div></div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="ghichu">
                    <div class="note" >
                        <input placeholder="Ghi chú đơn hàng" id="note" name="note" type="text" required>
                    </div>
                    <div class="hoadon">
                        <span><input type="checkbox">Xuất hóa đơn điện tử (nếu có)</div></span>
                </div>

                <div class="thanhtoan">
                    <div class="tongcong">
                        <strong>Tổng tiền:</strong>
                        <strong><?php echo $tongtien?>đ</strong>
                    </div>
                    <div class="btnthanhtoan"><a href="index.php?quanly=thanhtoan">
                        <input type="submit" name="thanhtoan" class="submitorder" value="THANH TOÁN"></input>
                    </div></a>
                    <small>Vui lòng xác nhận phương thức thanh toán ở bước sau</small>
                </div>

            </div>
            
            </section>
            
    </div>

</div>
                    <?php
                }else{
                    echo "
                <div id='maingiohang'>
                    <div class='container'>
                            <label></label>
                            <div class='topcontent'>
                                    <a href='index.php' class='returngiohang'>
                                    <i class='fa-solid fa-chevron-left'></i>
                                    Trở về
                                    </a>
                                </div>
                            <section>
                            <div class='content'>
                                <img src='https://assets.materialup.com/uploads/16e7d0ed-140b-4f86-9b7e-d9d1c04edb2b/preview.png' class='icon' alt=''>
                                <div class='trong'>Giỏ hàng của bạn đang trống!</div>
                                <div class='thank'>Vui lòng chọn mua ít nhất một sản phẩm để tiếp tục. Thank you~</div>
                            </div>
                            </section>
                        </div>
                    </div>";
                }
                ?>
<script type="text/javascript">
    function Fetchhuyen(id){
        $('#huyen').html('');
        $('#xa').html('<option>Chọn Xã/Phường</option>');
        $.ajax({
            type:'post',
            url:'pages/maingiohang/ajaxdata.php',
            data:{'id_tinh' : id},
            success:function(data){
                $('#huyen').html(data);
            }

        })
    }

    function Fetchxa(id){
        $('#xa').html('');
        $.ajax({
            type:'post',
            url:'pages/maingiohang/ajaxdata.php',
            data:{'id_huyen' : id},
            success:function(data){
                $('#xa').html(data);
            }

        })
    }
</script>
                