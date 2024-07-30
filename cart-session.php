<?php
// cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/tool.image.php';

/*
 Dữ liệu giỏ hàng được lưu theo cấu trúc sau:
 $_SESSION['cart'] = array(2) 
 { 
 	["YToxOntzOjEwOiJwcm9kdWN0X2lkIjtpOjQwO30="]=> int(2) 
 	["YToxOntzOjEwOiJwcm9kdWN0X2lkIjtpOjQzO30="]=> int(1) 
 }
 
 $_SESSION['cart'] có các key được mã hóa từ thông tin của sản phẩm
 
 */
global $cart_data;

$cart_data = array();
	

// Khởi tạo dữ liệu giỏ hàng
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) 
{
	$_SESSION['cart'] = array();
}

/*
	 Các thông tin của book được lấy từ db ở checkout/cart/add.php 
	 và ở đây nó được mã hóa thành một chuỗi kiểu base64.
	 Sang bên hàm getBooks() lại được giải mã để lấy các thông tin của sản phẩm. 
*/
function cartAdd($book_id, $qty = 1) 
{
	$cart_data = array();

	$book['book_id'] = (int)$book_id;

	$key = base64_encode(serialize($book));

	if ((int)$qty && ((int)$qty > 0)) 
	{
			if (!isset($_SESSION['cart'][$key])) {
				$_SESSION['cart'][$key] = (int)$qty;
			} else {
				$_SESSION['cart'][$key] += (int)$qty;
			}
	}
}

// Cập nhật giỏ hàng.
function cartUpdate($key, $qty) 
{
	global $cart_data;
	$cart_data = array();

	if ((int)$qty && ((int)$qty > 0) && isset($_SESSION['cart'][$key])) {
		$_SESSION['cart'][$key] = (int)$qty;
	} else {
		cartRemove($key);
	}
}

// Gỡ bỏ một sản phẩm khỏi giỏ hàng.
function cartRemove($key) 
{
	global $cart_data;
	$cart_data = array();

	unset($_SESSION['cart'][$key]);
}

// Xóa sạch sản phẩm khỏi giỏ hàng
// Được gọi ngay sau khi giỏ hàng 
// được lưu vào đơn hàng
function cartClear() 
{
	global $cart_data;
	$cart_data = array();

	$_SESSION['cart'] = array();
}

// Lấy ra tất cả các sản phẩm trong giỏ hàng
function cartGetBooks() 
{
	global $cart_data;
	
		if (!$cart_data) {
			foreach ($_SESSION['cart'] as $key => $quantity) {
				$book = unserialize(base64_decode($key));

				$book_id = $book['book_id'];

				$stock = true;

				$sql = " 
					SELECT * FROM book p 
					WHERE p.book_id = '{$book_id}' AND p.status = '1'
				";
				$book_query = db_row($sql);
				
				if (is_array($book_query) && !empty($book_query)) {

					$price = $book_query['price'];

					// Stock
					if (!$book_query['quantity'] || ($book_query['quantity'] < $quantity)) {
						$stock = false;
					}

					$cart_data[$key] = array(
						'key'             => $key,
						'book_id'      => $book_query['book_id'],
						'name'            => $book_query['name'],
						'model'           => $book_query['model'],
						'shipping'        => $book_query['shipping'],
						'image'           => $book_query['image'],
						'quantity'        => $quantity,
						'price'           => $price,
						'total'           => $price * $quantity
					);
				} else {
					cartRemove($key);
				}
			}
		}

		return $cart_data;
} // end getBooks()

/*
 Định dạng dữ liệu sản phẩm trước khi được hiển thị bên view html.
 khác so với hàm cartGetBooks() chỉ lấy dữ liệu thô.
 Mục đích là để đồng bộ mã nguồn (tránh dư thừa) ở các file 
 cart.php, checkout.php
 */
function cartGetBooksWithFormat()
{
	$books = array();
	
	foreach (cartGetBooks() as $book) 
	{
		// Ảnh đại diện sản phẩm
		if ($book['image']) 
		{
			$image = img_resize($book['image'], settings('config_image_cart_width'), settings('config_image_cart_height'));
		} else 
		{
			$image = '';
		}
		
		// Giá sản phẩm				
		$price = number_format($book['price'],0,'.',',').' ₫';
	
		// Tổng giá trị của số sản phẩm
		$total = number_format($book['total'], 2, '.', ',').' ₫';
					
					
		$books[] = array(
			'key'       => $book['key'],
			'thumb'     => $image,
			'name'      => $book['name'],
			'model'     => $book['model'],
			'quantity'  => $book['quantity'],
			'stock'     => $book['stock'] ? true : !(!settings('config_stock_checkout') || settings('config_stock_warning')),
			'price'     => $price,
			'total'     => $total,
			'href'      => urlBookDetails().'?book_id='.$book['book_id'] 
		);
	}
	
	return $books;
}
	
/*
	 Các thông tin của book được lấy từ db ở checkout/cart/add.php 
	 và ở đây nó được mã hóa thành một chuỗi kiểu base64.
	 Sang bên hàm getBooks() lại được giải mã để lấy các thông tin của sản phẩm. 
*/
function add($book_id, $qty = 1, $option = array(), $recurring_id = 0) 
{
	global $cart_data;
	
		$cart_data = array();

		$book['book_id'] = (int)$book_id;

		if ($option) {
			$book['option'] = $option;
	}

		if ($recurring_id) {
			$book['recurring_id'] = (int)$recurring_id;
	}

		$key = base64_encode(serialize($book));

		if ((int)$qty && ((int)$qty > 0)) {
			if (!isset($_SESSION['cart'][$key])) {
				$_SESSION['cart'][$key] = (int)$qty;
		} else {
				$_SESSION['cart'][$key] += (int)$qty;
		}
	}
}

/**
 * Tính tổng giá trị đơn hàng
 */	
function cartGetTotal() 
{
	$total = 0;
		
	foreach (cartGetBooks() as $book) 
	{
		$total += $book['price'] * $book['quantity'];
	}

	return $total;
}

/**
 * Định dạng tổng giá trị đơn hàng với ngăn cách phần nghìn và đơn vị tiền tệ
 * ví dụ: total = 2000000 ---> total with format = 2,000,000 ₫
 */
function cartGetTotalWithFormat()
{
	return number_format(cartGetTotal(),0,'.',',').' ₫';
}

/**
 * Trả về đoạn text hiển thị số sản phẩm trong giỏ hàng và tổng giá trị của chúng.
 * ví dụ: 3 sản phẩm - 14,000,000 ₫
 */
function cartGetTextCountAndTotal()
{
	return sprintf( "%s sản phẩm - %s", cartCountBooks(), cartGetTotalWithFormat());
}
	
function cartCountBooks() 
{
	$book_total = 0;

	$books = cartGetBooks();

	foreach ($books as $book) 
	{
		$book_total += $book['quantity'];
	}

	return $book_total;
}
	
function cartHasBooks() 
{
		return count($_SESSION['cart']);
}
	
function cartHasStock() 
{
		$stock = true;

		foreach (cartGetBooks() as $book) {
			if (!$book['stock']) {
				$stock = false;
		}
	}

	return $stock;
}
	
function cartHasShipping() 
{
	$shipping = false;

	foreach (cartGetBooks() as $book) 
		{
			if ($book['shipping']) {
				$shipping = true;

				break;
		}
	}

	return $shipping;
}

// Cấu hình trong bảng setting (key='flat_cost')
// Phí vận chuyển là như nhau cho dù khách hàng ở tỉnh nào
// vì giả sử công ty có trụ sở ở tỉnh đó
function cartGetShippingFee()
{
	return settings('flat_cost');
}

// Ví dụ: 100,000,000 ₫
function cartGetShippingFeeWithFormat()
{
	return number_format(cartGetShippingFee(),0,'.',',').' ₫';
}

/**
 * tính tổng giá trị đơn hàng mà không kể thuế
 */	
function cartGetSubTotal() 
{
	$total = 0;

	foreach (cartGetBooks as $book) 
	{
			$total += $book['total'];
	}

	return $total;
}
