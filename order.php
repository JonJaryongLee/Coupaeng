<?php
$conn = mysqli_connect(
	'localhost',
	'jony',
	'111111',
	'jony');

// customer 불러오기
$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);
$customer_list = '<select name="Customer_ID">';
while($row = mysqli_fetch_array($result)){
	$customer_list = $customer_list.
		'<option value="'.
		$row['Customer_ID'].
		'">'.
		$row['Name'].
		'</option>';
}
$customer_list = $customer_list.'</select>';

// product 불러오기
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$product_list = '<select name="Product_ID">';
while($row = mysqli_fetch_array($result)){
	$product_list = $product_list.
		'<option value="'.
		$row['Product_ID'].
		'">'.
		$row['Product_Name'].
		'</option>';
}
$product_list = $product_list.'</select>';
?>

<!DOCTYPE html>
<html>
<head>
	<title>쿠팽은 미사일배송!</title>
</head>
<body>
	<a href="index.php">첫 페이지로 돌아가기</a>
	<h1>주문하기</h1>
	<form action="order_process.php" method="POST">
		<div title="customer_choice">
			주문자
			<?=$customer_list?>
		</div>
		<div title="product_choice">
			제품
			<?=$product_list?>
		</div>
		<div title="order_quantity">
			수량
			<input type="number" name="Order_Quantity">
		</div>
		<section title="destination_info">
			<h4>배송지 정보</h4>
			<div name="to_name">
				받는사람
				<input type="text" name="To_Name">
			</div>
			<div name="to_address">
				배송지
				<input type="text" name="To_Address">
			</div>
			<div name="to_phone">
				연락처
				<input type="text" name="To_Phone">
			</div>
		</section>
		<input type="submit">
	</form>
</body>
</html>

