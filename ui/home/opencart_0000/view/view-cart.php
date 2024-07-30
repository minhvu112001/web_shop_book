<?php
// Nếu giỏ hàng có sản phẩm:
if (cartGetBooksWithFormat()) 
{
	include_once DIR_UI_HOME_THEMES."view/view-cart-books.php" ;
} 
else 
{
	// Nếu giỏ hàng không có sản phẩm
	include_once DIR_UI_HOME_THEMES."view/view-cart-empty.php";
} 



