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

    $uid = $_POST['uid'];

    $sql="SELECT eid,title,follow,info_type FROM estate_info WHERE uid = '". $uid ."' ORDER BY create_time DESC";

    $result=mysql_query($sql,$conn);

	$json_arr=array();
    while($row=mysql_fetch_assoc($result)){
        $arr=array(
            "eid"=>$row["eid"],
            "title"=>$row["title"],
            "follow"=>$row["follow"],
            "info_type"=>$row["info_type"]
        );
        array_push($json_arr,$arr);
    }

    echo json_encode($json_arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    mysql_close($conn);
?>