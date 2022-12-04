<?php 
    $k = $_POST['id'];
    $k = trim($k);
    include( 'connection.php' ) ;

    $sql="SELECT  tenLuatViPham, hanNopPhat, luatgiaothong.tienPhat, trangThaiNopPhat, tenQuanHuyen, tenDCCT, vipham.*
    FROM vipham, loivipham, diachichitiet, xaphuong, quanhuyen, luatgiaothong
    WHERE vipham.maViPham = loivipham.maViPham and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
    and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
    and vipham.maDCCT = diachichitiet.maDCCT
    and luatgiaothong.maLuatGiaoThong=loivipham.maLuatGiaoThong and tenQuanHuyen = '{$k}'";
    $res = mysqli_query($conn, $sql);
    $sn = 1;
    while ($row = mysqli_fetch_array($res)){
        $tienphat = $row['tienPhat'];
        $formattedNum = number_format($tienphat);
        ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $row['tenLuatViPham']; ?></td>
            <td><?php echo $row['hanNopPhat']; ?></td>
            <td><?php echo $formattedNum ?></td>
            <td><?php echo $row['trangThaiNopPhat']; ?></td>
            <td><?php echo $row['tenDCCT']; ?></td>
            <td><?php echo $row['tenQuanHuyen']; ?></td>
        </tr>
        <?php
    }

 
?>