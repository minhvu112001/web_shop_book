<?php 
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.banner.php';
include_once 'lib/table/table.book.php';
include_once 'lib/table/table.customer.php';
include_once 'lib/table/table.order.php';
include_once 'lib/table/table.order_details.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
if (!isset ($_SESSION['CUS_LOGGED']))
	header ("location: ".urlLogin());

$sort  = "o.order_id"; 
$order = "DESC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

// Truy vấn cơ sở dữ liệu để phân trang
$orders = array();

$filter_data = array(
	'filter_customer_id'   => $_SESSION['CUS_LOGGED'],
	'sort'                 => $sort,
	'order'                => $order,
	'start'                => ($page - 1) * settings('config_limit_admin'),
	'limit'                => settings('config_limit_admin')
);

$order_total = orderGetTotal($filter_data);
$results     = orderGetAll($filter_data);

foreach ($results as $result) 
{
	$orders[] = array(
		'order_id'      => $result['order_id'],
		'fullname'      => $result['fullname'],
		'status'        => $result['status'],
		'quantity'      => orderCountBooks($result['order_id']),
		'total'         => number_format($result['total'],0,'.',',').' ₫',
		'date_added'    => date("d/m/Y", strtotime($result['date_added'])),
		'view'          => urlOrderDetails() . '?order_id=' . $result['order_id']
	);
}

// Phân Trang
$url = urlOrderHistory();

$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";

paginate($order_total, $page,settings('config_limit_admin'), $url);

// Nội dung riêng của trang...
$web_title = "Lịch Sử Đơn Hàng";
$web_content = DIR_UI_HOME_THEMES."view/view-order-history.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site.
include_once FILE_LAYOUT_HOME;	

