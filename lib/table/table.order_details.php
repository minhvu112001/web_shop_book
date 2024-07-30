<?php
function orderBookGetAll($order_id) 
{
	$sql = "SELECT * FROM `order_details` WHERE order_id = '" . (int)$order_id . "'";
	
	return db_q($sql);
}

function orderCountBooks($order_id) 
{
	$sql = "SELECT SUM(quantity) FROM `order_details` WHERE order_id  = '" . (int)$order_id . "'";
	
	return db_one($sql);
}