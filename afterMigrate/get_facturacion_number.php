<?php
	require_once('./conexion.php');
	header('Content-Type: application/json; charset=utf-8');
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

    $sql = "SELECT order_id FROM orders WHERE order_status=1";
	$result = mysqli_query($conexion,$sql);
	$rows = mysqli_num_rows($result);
	$registros["rows"] = $rows;	

	if(isset($rows)){
		print_r (json_encode($registros, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}else{
		print_r(json_encode([]));
	}

mysqli_close($conexion);

?>