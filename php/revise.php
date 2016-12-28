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
    $title = $_POST['title'];
    $area = $_POST['area'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $construct = $_POST['construct'];
    $time = date('y-m-d H:i:s',time()+7*3600);

    $sql = "UPDATE estate_info SET title = '" . $title . "', area = '".$area."', address = '".$address."', price = '".$price."',construct = '".$construct."',create_time = '".$time."' WHERE eid = '" . $eid . "'";
	$result = mysql_query($sql);
	if($result == 1){
		$json_res = array("code"=>200);
	}else{
		$json_res = array("code"=>204);
	}
	echo json_encode($json_res, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    mysql_close($conn);
?>