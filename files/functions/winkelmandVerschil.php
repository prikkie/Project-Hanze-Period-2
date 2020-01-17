<?php
session_start();
if (array_key_exists('add', $_GET)) {
	echo add($_GET['add']);


} elseif (array_key_exists('sub', $_GET)) {

	echo sub($_GET['sub']);
}


function add($product_id)
{
	return $_SESSION['carts']['products'][$product_id] += 1;
}

function sub($product_id)
{
	if ($_SESSION['carts']['products'][$product_id] <= 1) {
		unset($_SESSION['carts']['products'][$product_id]);
		return 0;
	} else {

		return $_SESSION['carts']['products'][$product_id] -= 1;

	}

}
