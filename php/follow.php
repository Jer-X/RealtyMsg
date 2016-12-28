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

    $eid = $_POST['e_id'];

    $sql = "SELECT follow FROM estate_info WHERE eid = '" . $eid . "'";
    $result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	$num = $row['follow'];
	$num = $num + 1;

	$sql = "UPDATE estate_info SET follow = '" . $num . "' WHERE eid = '" . $eid . "'";
	$result = mysql_query($sql);

	if($result == 1){
		$sql = "SELECT follow FROM estate_info WHERE eid = '" . $eid . "'";
		$result = mysql_query($sql);

		$json_arr=array();

	    while($row=mysql_fetch_assoc($result)){
	        $arr=array(
	            "follow"=>$row["follow"]
	        );
	        array_push($json_arr,$arr);
	    }

	    echo json_encode($json_arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}else{
		echo 204;
	}

    mysql_close($conn);
?>