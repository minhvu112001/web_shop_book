<?php
/*
 Phần cart-info.php là cần thiết để trả lại nội dung cho ajax request.
 Nó khác so với shopping-cart.php là toàn bộ trang giỏ hàng
 */
include_once 'configs.php';
include_once 'cart-session.php';

// Nếu giỏ hàng có sản phẩm:
if (cartGetBooksWithFormat()) 
{
	include_once DIR_UI_HOME_THEMES."view/view-cart-books.php" ;
	die();
} 

// Nếu giỏ hàng không có sản phẩm
include_once DIR_UI_HOME_THEMES."view/view-cart-empty.php";

