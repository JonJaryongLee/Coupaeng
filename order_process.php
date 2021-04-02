<?php
$conn = mysqli_connect(
	'localhost',
	'jony',
	'111111',
	'jony');

$sql = "SELECT Product_Quantity FROM product WHERE Product_id=".
	"${_POST['Product_ID']}";
$result = mysqli_query($conn, $sql);
$product_quantity = mysqli_fetch_array($result);
$product_quantity = $product_quantity['Product_Quantity'];

if($product_quantity < $_POST['Order_Quantity']){
	echo '재고가 없습니다. <a href="order.php">뒤로가기</a>';
} else {
	//order insert
	$sql = "
		INSERT INTO `order`
			(`Customer_ID`, `Order_Quantity`, `To_Name`, `To_Address`, `To_Phone`)
			VALUES (
				'{$_POST['Customer_ID']}',
				'{$_POST['Order_Quantity']}',
				'{$_POST['To_Name']}',
				'{$_POST['To_Address']}',
				'{$_POST['To_Phone']}'
			)
	";
	$result = mysqli_query($conn, $sql);
	if ($result === false) {
		error_log(mysqli_error($conn));
	}
	// order의 맨 마지막 pk id값 가져오는 법
	// https://www.w3schools.com/php/php_mysql_insert_lastid.asp
	$last_id = mysqli_insert_id($conn);

	// demand insert
	// last_id 사용
	$sql = "
		INSERT INTO `demand`
			(`Order_ID`,`Product_ID`,`Demand_Date`)
			VALUES (
				'{$last_id}',
				'{$_POST['Product_ID']}',
				NOW()
			)
	";
	$result = mysqli_query($conn, $sql);
	if ($result === false) {
		error_log(mysqli_error($conn));
	}

	// 재고 차감을 위한 product update
	$current_quantity = $product_quantity - $_POST['Order_Quantity'];
	$sql = "
		UPDATE `product`
			SET
			`Product_Quantity` = '{$current_quantity}'
			WHERE
			`Product_ID` = '{$_POST['Product_ID']}'
	";
	$result = mysqli_query($conn, $sql);
	if ($result === false) {
		error_log(mysqli_error($conn));
	} else {
		echo '주문 성공! <a href="order.php">뒤로가기</a>';
	}	
}
?>

