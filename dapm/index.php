<?php include( 'connection.php' ) ;

// select dữ liệu ra để vẽ biểu đồ

    $sql = "SELECT quanhuyen.tenQuanHuyen	, COUNT(vipham.maViPham) as soluongvp
    FROM vipham, diachichitiet, xaphuong, quanhuyen
            WHERE  diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
            and xaphuong.maQuanHuyen=quanhuyen.maQuanHuyen 
            and vipham.maDCCT = diachichitiet.maDCCT        
    GROUP by quanhuyen.tenQuanHuyen";
    $res = mysqli_query($conn, $sql);
    $chart_data=array();
    $quan=array();
    $soluong=array();
    
    while($row=mysqli_fetch_array($res)){
       
        $quan[]=$row['tenQuanHuyen'];
        $soluong[]=$row['soluongvp'];
        $chart_data[] = array(
            'quan' => $row['tenQuanHuyen'],
            'soluong' => $row['soluongvp']
        );
    }
    $lable = '';
    $value = '';
    for ($i = 0; $i < count($quan); $i++) {
        if ($i == (count($quan) - 1))
        {
            $lable .= '"'.$quan[$i].'"';
            
        }            
        else {
            $lable .= '"'.$quan[$i].'"' . ', ';
            
        }
    }
    for ($i = 0; $i < count($soluong); $i++) {
        if ($i == (count($soluong) - 1))
        {
            
            $value .= $soluong[$i];
        }            
        else {
            
            $value .= $soluong[$i] . ', ';
        }
    }
    // $chart_data[]=substr($chart_data,0,-2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thống kê</title>

    <!-- boostrap -->
    <link rel="stylesheet" href="boostrap-5/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="boostrap-5/css/bootstrap-grid.css">
    <link rel="stylesheet" href="style_admin.css">
    
    <link rel="stylesheet" href="boostrap-5/css/styles-admin.css">
    <link rel="stylesheet" href="font/google-font.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bieu do -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src='Chart.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
 <!-- header -->
     <nav class="sb-topnav navbar navbar-expand navbar">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">
            <img id="logoimg" src="Logo_GTDN.png" alt="">
        </a>
        <!-- Sidebar Toggle-->
       <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div>
                ADMIN  
                <img id="userimg" src="profile.png" alt="">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Admin</a></li>
                    <li><a class="dropdown-item" href="#!">Đăng Xuất</a></li>
                    
                </ul>
            </li>
        </ul>
    </nav>

    <!-- tab menu -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- menu 01 -->
                        <div class="sb-sidenav-menu-heading">Quản lý</div>
                        <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts01" aria-expanded="false" aria-controls="collapseLayouts01">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Quản lý vi phạm
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts01" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-dark" href="layout-static.html">Thêm vi phạm</a>
                                <a class="nav-link text-dark" href="layout-sidenav-light.html">Sửa vi phạm</a>
                                <a class="nav-link text-dark" href="layout-sidenav-light.html">Xóa vi phạm</a>

                            </nav>
                        </div>
                        <a class="nav-link collapse text-dark" href="#" data-bs-toggle="collapse" >
                            <div class="sb-nav-link-icon"><i class="bi bi-person-bounding-box"></i></div>
                            Quản lý người dùng
                            <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                        </a>
                        <a class="nav-link collapse text-dark" href="#" data-bs-toggle="collapse" >
                            <div class="sb-nav-link-icon"><i class="bi bi-person-bounding-box"></i></div>
                            Quản lý cá nhân
                            <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                        </a>
                        
                        <!-- menu 02 -->
                        <div class="sb-sidenav-menu-heading">Tra cứu</div>
                        <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts02" aria-expanded="false" aria-controls="collapseLayouts02">
                            <div class="sb-nav-link-icon"><i class="bi bi-search-heart-fill"></i></div>
                            Tra cứu vi phạm
                            <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                        </a>
                        
                        <!-- menu 03 -->
                        <div class="sb-sidenav-menu-heading">Thống kê</div>
                        <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts03" aria-expanded="false" aria-controls="collapseLayouts03">
                            <div class="sb-nav-link-icon"><i class="bi bi-pie-chart-fill"></i></div>
                            Thống kê
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts03" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-dark" href="layout-static.html" style="color: #C68601;">Thống kê vi phạm</a>
                                <a class="nav-link text-dark" href="layout-sidenav-light.html">Thống kê người dùng</a>
                                <a class="nav-link text-dark" href="layout-sidenav-light.html">Thống kê nộp phạt</a>

                            </nav>
                        </div>
                        
                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
            </nav>
        </div>

    </div>
    <!-- nội dung thống kê -->
    <div class="content-thongke-qtv" id="content-thongke-qtv">
        <h2 style="font-size: 1.7rem;">Thống kê/Vi phạm</h2>
        <!-- search -->
        
        <!-- result -->
        <!-- thống kê theo ngày -->
        <div class="thongke_ngay">

            <?php include( 'timkiem.php' ) ; ?>  
                
        </div>
        
            <!-- thống kê nổi bật -->
            <div class="thongke_noibat">
                
                
                <main>
                <div class="cards">
                    
                        <div class="card-single">
                            <?php 
                            $sql = 'SELECT quanhuyen.tenQuanHuyen , COUNT(vipham.maDCCT) as sl
                            FROM vipham, diachichitiet, xaphuong, quanhuyen 
                            WHERE vipham.maDCCT = diachichitiet.maDCCT 
                                    and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
                                    and xaphuong.maQuanHuyen = quanhuyen.maQuanHuyen	
                            GROUP by quanhuyen.tenQuanHuyen
                            HAVING COUNT(vipham.maDCCT)>=(SELECT MAX(sl) FROM(SELECT  COUNT(vipham.maDCCT) as sl
                                                                                FROM vipham, diachichitiet, xaphuong, quanhuyen 
                                                                                WHERE vipham.maDCCT = diachichitiet.maDCCT 
                                                                                    and diachichitiet.maXaPhuong = xaphuong.maXaPhuong 
                                                                                    and xaphuong.maQuanHuyen = quanhuyen.maQuanHuyen	
                                                                                GROUP by quanhuyen.tenQuanHuyen)TMP)';
                            // $max=MAX($sql);
                            $res= mysqli_query($conn, $sql);
                            if($res==TRUE){
                                $count = mysqli_num_rows($res);
                                if($count >0){
                                    while ($row = mysqli_fetch_assoc($res)){
                                        $tenquan = $row['tenQuanHuyen'];
                                        ?>
                                        <?php
                                    }
                                }else{

                                }
                            }
                        ?>
                            <div>
                                <h1 style="font-size: 2rem;">
                                <?php echo $tenquan ?>
                                </h1>
                                <span>Quận vi phạm nhiều nhất</span>
                            </div>
                            <div>
                                <span class="las la-clipboard-list"></span>
                            </div>
                        </div>
                        <div class="card-single" style="background: #F7D358;">
                            
                            <?php 
                                $sql='SELECT COUNT(maViPham) as total FROM vipham';
                                $res = mysqli_query($conn, $sql);
                                
                                $data = mysqli_fetch_assoc($res);
                                
                            ?>
                            <div>
                                <h1><?php echo $data['total']; ?></h1>
                                <span>Số lượng vi phạm</span>
                            </div>
                            <div>
                                <span class="las la-user"></span>
                            </div>
                        </div>
                        <div class="card-single" style="background: #F5DA81;">
                            <?php 
                                $sql='SELECT COUNT(trangThaiNopPhat) AS nopphat FROM vipham
                                WHERE trangThaiNopPhat = "Đã nộp"';
                                $res = mysqli_query($conn, $sql);
                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);
                                    if($count >0){
                                        while ($row = mysqli_fetch_assoc($res)){
                                            $danop = $row['nopphat'];
                                            ?>
                                            <?php
                                        }
                                    }else{
    
                                    }
                                }
                                
                                
                            ?>
                            <div>
                                <h1><?php echo $danop ?></h1>
                                <span>Đã nộp phạt</span>
                            </div>
                            <div>
                                <span class="las la-shopping-bag"></span>
                            </div>
                        </div>
                        <div class="card-single" style="background: #F3F781;">
                        <?php 
                                $sql='SELECT COUNT(trangThaiNopPhat) AS chuanopphat FROM vipham
                                WHERE trangThaiNopPhat = "Chưa nộp"';
                                $res = mysqli_query($conn, $sql);
                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);
                                    if($count >0){
                                        while ($row = mysqli_fetch_assoc($res)){
                                            $chuanop = $row['chuanopphat'];
                                            ?>
                                            <?php
                                        }
                                    }else{
    
                                    }
                                }
                                
                                
                            ?>
                            <div>
                                <h1><?php echo $chuanop ?></h1>
                                <span>Chưa nộp phạt</span>
                            </div>
                            <div>
                                <span class="lab la-google-wallet"></span>
                            </div>
                        </div>
                    </div>

                </main>

            </div>
            <!-- thống kê theo ngày -->
            <div style="margin-top: 2rem;">
                <canvas id="myChart" style="height: 100px;">
                    
            </canvas>
            <p style="margin-top: 3rem; text-align:center;font-size:1.2rem;font-style:italic;">
                Biểu đồ thể hiện số lượng vi phạm các quận ở thành phố Đà Nẵng
            </p>
            </div>
            
            <canvas id="buyers" >
                <!-- <h2 align="center">sjkjdfksfjksfj</h2>
                <h3 align="center">jadakjfksfjklsfj,iajdkajdsak</h3> -->
                <br /> <br/>
                <div id="myfirstchart"></div>
                <?php 
                echo ($lable . ' - '.$value);
                
                
                ?>
            </canvas>


            <!-- thống kê theo tháng -->
            <div class="thongke_thang" id="thongke_thang">
                <h2 style="border-bottom: #D8D8D8 solid 0.7px; padding-bottom:20px;">Thống kê số lượng theo tháng/năm</h2>
                                <?php include('timkiem2.php'); ?>
            </div>
            <!-- vi phạm phổ biến -->
            <div class="thongke_vp_phobien" id="thongke_vp_phobien">
                <h2 style="border-bottom: #D8D8D8 solid 0.7px; padding-bottom:20px;padding-left:40px;">Số lượng các loại vi phạm</h2>
                <div class="month" style="display: flex;">
                      
                    
                    
                    <div class="col-md-3">
                        
                    </div>
                </div>
                <table class="table_vipham"  cellspacing=0 cellpading=0>
                    <tr >
                        <th >Tên vi phạm</th>
                        <th >Số lượng</th>  
                    </tr>

                    <?php
                        $sql="SELECT tenLuatViPham, COUNT(vipham.maViPham) as soluong
                        FROM vipham, loivipham, luatgiaothong
                        WHERE vipham.maViPham = loivipham.maViPham and luatgiaothong.maLuatGiaoThong = loivipham.maLuatGiaoThong
                        GROUP BY tenLuatViPham ";
                        $res = mysqli_query($conn, $sql);
                        if($res==TRUE){
                            $count = mysqli_num_rows($res);
                            $sn=1;
                            if($count > 0){
                                while ($row = mysqli_fetch_assoc($res)){
                                    // $mavp = $row['maViPham'];
                                    $tenvp = $row['tenLuatViPham'];
                                    $soluong = $row['soluong']
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $tenvp ?></td>
                                        <td style="padding-left: 50px;"><?php echo $soluong ?></td>
                                        
                                    </tr>
                                    <?php
                                }
                            }else{

                            }
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </div>
  
    
<!-- vẽ biểu đồ -->
<script>
        const labels = [<?php echo ($lable) ?>];

        const data = {
            labels: labels,
            datasets: [{
                label: ['số lượng vp'],
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?php echo ($value) ?>],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

     
     <script type="text/javascript" src="boostrap-5/js/bootstrap.bundle.js"></script>
     <script type="text/javascript" src="boostrap-5/js/bootstrap.bundle.min.jsx"></script>
</body>
</html>

