<?php 
    
            //Thong so ket noi CSDL
            $severname ="localhost"; 
            $username ="root";
            $password =""; 
            $db_name ="testdapm";
 
        // create connection
       $conn = mysqli_connect($severname, $username, $password, $db_name);
       if(!$conn){
           die("connection failed:".mysqli_connect_error());
       }
    //    }else{
    //        echo "success";
    //    }
?>