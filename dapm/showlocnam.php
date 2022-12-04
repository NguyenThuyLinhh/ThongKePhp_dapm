<?php 
    $k = $_POST['id'];
    $k = trim($k);
    include( 'connection.php' ) ;

    $sql="SELECT DISTINCT MONTH(ngayGioViPham) as thang, COUNT(ngayGioViPham) as soluong, YEAR(ngayGioViPham) as nam
    FROM vipham
    WHERE YEAR(ngayGioViPham) = '{$k}'
    group by thang";
        $res = mysqli_query($conn, $sql);
        $svr = '';
        while ($row = mysqli_fetch_array($res)){
            $month = $row['thang'];
            $year = $row['nam'];
            $soluong = $row['soluong'];
            $svr .='<tr >
                <td>Tháng '.$month.'</td>
                <td>'.$year.'</td>
                <td style="padding-left: 50px;">'.$soluong.' </td>
            </tr>';
             }
            // echo $sql;
            echo $svr;

 
?>