<?php
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.order.php';

checkLogin();

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;
	
$order_info = orderGetById($order_id);
	
/*
 Điều hướng ruột bánh mỳ (Breadcrumbs Navigation)
 Gán các đường dẫn bán tuyệt đối vào điều hướng.
 */
			$url = '?';

			if (isset($_GET['filter_order_id'])) {
				$url .= '&filter_order_id=' . $_GET['filter_order_id'];
			}

			if (isset($_GET['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($_GET['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($_GET['filter_total'])) {
				$url .= '&filter_total=' . $_GET['filter_total'];
			}

			if (isset($_GET['filter_date_added'])) {
				$url .= '&filter_date_added=' . $_GET['filter_date_added'];
			}

			if (isset($_GET['sort'])) {
				$url .= '&sort=' . $_GET['sort'];
			}

			if (isset($_GET['order'])) {
				$url .= '&order=' . $_GET['order'];
			}

			if (isset($_GET['page'])) {
				$url .= '&page=' . $_GET['page'];
			}
			
/*
 Các đường dẫn gửi sang bên view được cấu hình
 một chỗ ở đây nhằm tránh bị trùng lặp bên view
 */			
$url_invoice  = urlAdminOrderInvoice().'?order_id=' . (int)$_GET['order_id'];
$url_cancel   = urlAdminOrder() . $url;

// Các sản phẩm của đơn hàng
$books = array();

foreach (orderGetBooks($_GET['order_id']) as $book) 
{
	// Tinh chỉnh dữ liệu trước khi gửi sang view
	$books[] = array(
		'book_id'       => $book['book_id'],
		'name'    	 	   => $book['name'],
		'model'    		   => $book['model'],
		'quantity'		   => $book['quantity'],
		'price'    		   => number_format($book['price'],0,'.',',').' ₫', 
		'total'    		   => number_format($book['total'],0,'.',',').' ₫',
		'href'     		   => urlAdminBookEdit().'?book_id=' . $book['book_id']
	);
}// end foreach
		
$web_title = 'Đơn hàng';

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-order-info.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;
