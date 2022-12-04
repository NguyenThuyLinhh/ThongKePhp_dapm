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

<!-- jquery tìm kiếm -->
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</head>
<body>
    <?php 
        $sql="SELECT DISTINCT MONTH(ngayGioViPham) as thang, COUNT(ngayGioViPham) as soluong, YEAR(ngayGioViPham) as nam
        FROM vipham
        WHERE YEAR(ngayGioViPham)
        group by nam";
        $res = mysqli_query($conn, $sql);
         ?>

    <!-- <h2>Filterable Table</h2>
    <p>Type something in the input field to search the table for first names, last names or emails:</p>   -->
    <!-- <input id="myInput" type="text" placeholder="Search.."> -->
    <div class="input-group" style="margin-left: 20px; display:flex; ">
        <div class="form-outline">
            <input id="myInput" type="text" name="timkiem" require  
                id="form2" class="form-control" placeholder="Tìm kiếm" style="height: 3rem; width:15rem; margin-top:25px; border:rgb(255, 99, 132) solid 1px;"/>
            <label class="form-label" for="datatable-search-input"></label>
        </div>
        <div style="margin-left:20px; margin-top:3px;  ">
            Năm 
            <select name="" id="chon_nam" class="form-select" onchange="selectYear()" style="border:rgb(255, 99, 132) solid 1px; height:3rem;">
            <?php while ($row = mysqli_fetch_array($res)){
                ?>
                <option value="<?php echo $row['nam']; ?>"><?php echo $row['nam']; ?></option>
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
                <th >Tháng</th>
                <th >Năm</th>
                <th >Số lượng</th>     
            </tr>
        </thead>
        <tbody id="myTable">
        <?php 
            $sql="SELECT DISTINCT MONTH(ngayGioViPham) as thang, COUNT(ngayGioViPham) as soluong, YEAR(ngayGioViPham) as nam
                FROM vipham
                WHERE YEAR(ngayGioViPham)
                group by thang, nam
                Order by nam desc";
            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count >0){
                    
                    while ($row = mysqli_fetch_assoc($res)){
                        $month = $row['thang'];
                            $year = $row['nam'];
                            $soluong = $row['soluong']
                        ?>
                       
                            <tr >
                                <td><?php echo "Tháng $month"?></td>
                                <td><?php echo " $year"?></td>
                                <td style="padding-left: 50px;"><?php echo $soluong ?></td>
                            </tr>
                        
                        
                        <?php
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
