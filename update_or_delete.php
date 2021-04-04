<?php
if($_POST['update']){
	$show = "
		<h1>주문수정</h1>
		<div title='order_id'>
			주문번호 299
		</div>
		<div title='customer_name'>
			주문자 황혁주
		</div>
		<form action='update_process.php' method='POST'>
			<div title='product_choice'>
				제품
				<select>
					<option>횡성한우</option>
					<option>벚꽃원피스</option>
					<option>햇반</option>
				</select>
			</div>
			<div title='order_quantity'>
				수량
				<input type='number' name='Order_Quantity'>
			</div>
			<section title='destination_info'>
				<h4>배송지 정보</h4>
				<div name='to_name'>
					받는사람
					<input type='text' name='To_Name'>
				</div>
				<div name='to_address'>
					배송지
					<input type='text' name='To_Address'>
				</div>
				<div name='to_phone'>
					연락처
					<input type='text' name='To_Phone'>
				</div>
			</section>
			<br>
			<input type='submit' value='수정'>
		</form>
	";
}
if($_POST['delete']){
	$show = "
		<h1>주문삭제</h1>
		<p>다음을 삭제하시겠습니까?</p>
		<div title='order_id'>주문번호 299</div>
		<div title='order_name'>주문자 황혁주</div>
		<div title='product_name'>황사마스크 5개</div>
		<div title='to_name'>받는사람: 박준수</div>
		<div title='to_address'>배송지: 진주시 가좌동</div>
		<br>
		<a href='delete_process.php'>예</a>
		<a href='order_list.php'>아니오</a>
	";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>쿠팽은 미사일배송!</title>
</head>
<body>
	<a href="order_list.php">주문목록으로 돌아가기</a>
	<?=$show?>
</body>
</html>

