<?php include( 'connection.php' ) ; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="boostrap-5/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="boostrap-5/css/bootstrap-grid.css">
    <link rel="stylesheet" href="style_admin.css">
    <script type="text/javascript" src="loc.js"></script>
    <link rel="stylesheet" href="boostrap-5/css/styles-admin.css">
    <link rel="stylesheet" href="font/google-font.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#Input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#TableList tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
    #TableList tr:nth-child(even) {
    background-color: #f8f1d2;
}
</style>
</head>
<body>
    <?php 
        $sql="SELECT  tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, tenQuanHuyen, tenDCCT
        FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
        WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
        and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
        and vipham.maDCCT = diachichitiet.maDCCT
        and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong
        group by tenQuanHuyen, quanhuyen.maQuanHuyen";
        $res=mysqli_query($conn,$sql);

        $query="SELECT  tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, tenQuanHuyen, tenDCCT
        FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
        WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
        and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
        and vipham.maDCCT = diachichitiet.maDCCT
        and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong
        group by trangThaiNopPhat";
        $ress=mysqli_query($conn,$query);
    ?>

    <!-- <h2>Filterable Table</h2>
    <p>Type something in the input field to search the table for first names, last names or emails:</p>   -->
    <!-- <input id="myInput" type="text" placeholder="Search.."> -->
    <div class="input-group" style="margin-left: 5px; text-align:center;">
        <div class="form-outline">
            
            <input id="Input" type="text" name="timkiem" require  
                id="form2" class="form-control" placeholder="Tìm kiếm" style="height: 3rem; width:30rem; margin-top:5px; border:rgb(255, 99, 132) solid 1px;"/>
            <label class="form-label" for="datatable-search-input"></label>
        </div>

        <!-- quận -->
        <div style="margin-left:45px; margin-top:-17px; ">
            Quận
            <select name="" id="chon_quan" class="form-select" onchange="selectQuan()" style="border:rgb(255, 99, 132) solid 1px; height:3rem; width:10rem;">
            <?php while ($row = mysqli_fetch_array($res)){
                ?>
                <option value="<?php echo $row['tenQuanHuyen']; ?>"><?php echo $row['tenQuanHuyen']; ?></option>
            <?php
            }?>
                
            </select>
        </div>

        <!-- trạng thái nộp phạt -->
        <div style="margin-left:15px; margin-top:-17px; ">
            Trạng thái nộp phạt
            <select name="" id="chon_trangthai" class="form-select" onchange="selectTrangThai()" style="border:rgb(255, 99, 132) solid 1px; height:3rem;width:10rem;">
            <?php while ($row = mysqli_fetch_array($ress)){
                ?>
                <option value="<?php echo $row['trangThaiNopPhat']; ?>"><?php echo $row['trangThaiNopPhat']; ?></option>
            <?php
            }?>
                
            </select>
        </div>
        <!-- <button type="submit" class="btn btn-primary" style="height: 3rem;margin-top:10px;">
            <i class="fas fa-search"></i>
        </button> -->
    </div>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th >Tên vi phạm</th>   
                <th>Hạn nộp</th>
                <th >Tiền phạt</th>
                <th>Trạng thái</th>
                <th>Địa chỉ</th>
                <th >Quận</th>   
            </tr>
        </thead>
        <tbody id="TableList">
        <?php 
            $results_per_page = 10;
            $sql = "SELECT  tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, quanhuyen.tenQuanHuyen, tenDCCT
            FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
            WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
            and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
            and vipham.maDCCT = diachichitiet.maDCCT
            and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong
           
     UNION
     SELECT tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, quanhuyen.tenQuanHuyen, tenDCCT
            FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
            WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
            and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
            and vipham.maDCCT = diachichitiet.maDCCT
            and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong
            ";
            $res = mysqli_query($conn, $sql);

            $number_of_result = mysqli_num_rows($res);
            //determine the total number of pages available
            $number_of_page = ceil ($number_of_result / $results_per_page);
            //determine which page number visitor is currently on
            if (!isset ($_GET['page']) ) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            //determine the sql LIMIT starting number for the results on the displaying page
            $page_first_result = ($page-1) * $results_per_page;
            //retrieve the selected results from database
            $sql = "SELECT  tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, tenQuanHuyen, tenDCCT, vipham.*
            FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
            WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
            and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
            and vipham.maDCCT = diachichitiet.maDCCT
            and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong  LIMIT " . $page_first_result . ',' . $results_per_page;
            $res= mysqli_query($conn, $sql);
            // $i=1 ; foreach ($ress as $key => $value) {
            //     echo $i; $i++;
            // }
            
            if($res==TRUE){
                $count=mysqli_num_rows($res);
                $sn = 1;
                if($count > 0){
                    while ($row = mysqli_fetch_assoc($res)){
                        $mavp = $row['maViPham'];
                        $tenvp = $row['tenLuatViPham'];
                        $hannop = $row['hanNopPhat'];
                        $tienphat = $row['tienPhat'];
                        $formattedNum = number_format($tienphat);
                        $trangthai = $row['trangThaiNopPhat'];
                        $diachi = $row['tenDCCT'];
                        $quan = $row['tenQuanHuyen'];
                        ?>
                        
                            <tr >
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $tenvp ?></td>
                                <td><?php echo $hannop ?></td>
                                <td><?php echo $formattedNum ?></td>
                                <td><?php echo $trangthai ?></td>
                                <td><?php echo $diachi ?></td>
                                <td><?php echo $quan ?></td>
                            </tr>
                        
                        
                        <?php
                    }
                    for($page = 1; $page<= $number_of_page; $page++) {

                        echo ' <a href = "index.php?page='  . $page . '" style="color:black; text-decoration: none;padding:10px; ">' . $page . '</a>';
                        
                    }
                }else{

                }
            }
            
            
        ?>
        </tbody>
        
    </table>

    
    <!-- <p>Note that we start the search in tbody, to prevent filtering the table headers.</p> -->

</body>
</html>
