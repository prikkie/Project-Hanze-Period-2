<?php

if (array_key_exists('add', $_GET)) {
	echo add($_GET['add']);

} elseif (array_key_exists('sub', $_GET)) {

	echo sub($_GET['sub']);
}

function add($product_id)
{
	if (isset($_SESSION['cart']['products'][$product_id])) {
		$_SESSION['cart']['products'][$product_id] += 1;
		echo "hey!";
	} else {
		$_SESSION['cart']['products'][$product_id] = 1;
	}

	return $_SESSION['cart']['products'][$product_id];
}

function sub($product_id)
{
	if (isset($_SESSION['cart']['products'][$product_id])) {
		$_SESSION['cart']['products'][$product_id] -= 1;
	} else {
		return false;
	}

	if ($_SESSION['cart']['products'][$product_id] <= 0) {
		unset($_SESSION['cart']['products'][$product_id]);
		return 0;
	}

	return $_SESSION['cart']['products'][$product_id];
}