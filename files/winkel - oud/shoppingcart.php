<?php

function initCart($conn)
{
	console . log($_SESSION['cart']);
	console . log("hey!");
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart']['products'] = '';
	}

	if (empty($_SESSION['cart']['products'])) {
		return [];
	}

	$product_ids = array_keys($_SESSION['cart']['products']);
	if (count($product_ids) == 0) {
		return [];
	}

	$product_ids = join(",", $product_ids);
	$result = $conn->query("
				select * from products
				where id IN (" . $product_ids . ")
			");


	return $result;
}






