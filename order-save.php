<?php
// cấu hình hệ thống
include_once 'configs.php';
// thư viện hàm
include_once 'lib/table/table.order.php';
include_once 'lib/tool.image.php';
include_once 'cart-session.php';


	$order_data = array();
	$order_data['totals'] = array();
	
	// vẫn phải lưu thông tin khách hàng trong đơn hàng
	// để lưu vết lịch sử. Đề phòng trong tương lai thông tin khách hàng bị thay đổi
	// hoặc khách hàng muốn nhập thông tin không giống với thông tin tài khoản
	// lưu trên hệ thống.
	$order_data['customer_id']       = isset($_SESSION['CUS_LOGGED']) ? $_SESSION['CUS_LOGGED'] : 0;
	$order_data['email']             = $_POST['email']; 
	$order_data['telephone']         = $_POST['telephone']; 
	
	// shipping
	// @todo: chỉ sử dụng fullname thôi, bởi vì site này là cho thị trường Việt Nam
	$order_data['fullname'] = $_POST['fullname']; // tạm dùng luôn cho fullname 
	$order_data['address']   = $_POST['address']; 
	
	$order_data['comment'] = $_POST['comment'];
	$order_data['total']   = cartGetTotal() ;//$total;
	
	$order_data['books'] = array();

	foreach (cartGetBooks() as $book) 
	{
		$order_data['books'][] = array(
			'book_id' => $book['book_id'],
			'name'       => $book['name'],
			'model'      => $book['model'],
			'quantity'   => $book['quantity'],
			'price'      => $book['price'],
			'total'      => $book['total'],
		);
	}
	
	// add order history
	// clear cart tooo
	//$_SESSION['order_id'] = orderAdd($order_data);
	$order_id = orderAdd($order_data);
	cartClear();
	