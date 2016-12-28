<?php
    require './database.php';
    header('content-type:application/json;charset=utf8');
    
    $conn=mysql_connect($servername,$username,$password);
    if (!$conn){
        die('Could not connect: ' . mysql_error());
    }
    $db_sel=mysql_select_db($db,$conn);
    $sql = "set names utf8";
    mysql_query($sql,$conn);

    $eid = $_POST['eid'];

    $sql="SELECT eid,title,area,address,price,construct FROM estate_info WHERE eid = '". $eid ."' ORDER BY create_time DESC";

    $result=mysql_query($sql,$conn);

	$json_arr=array();
    while($row=mysql_fetch_assoc($result)){
        $arr=array(
            "eid"=>$row["eid"],
            "title"=>$row["title"],
            "area"=>$row["area"],
            "address"=>$row["address"],
            "price"=>$row["price"],
            "construct"=>$row["construct"]
        );
        array_push($json_arr,$arr);
    }

    echo json_encode($json_arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    mysql_close($conn);
?>