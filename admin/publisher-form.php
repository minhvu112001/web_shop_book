<?php
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.publisher.php';
include_once '../lib/tool.image.php';

$url = '';

		if (isset($_GET['sort'])) {
			$url .= '&sort=' . $_GET['sort'];
		}

		if (isset($_GET['order'])) {
			$url .= '&order=' . $_GET['order'];
		}

		if (isset($_GET['page'])) {
			$url .= '&page=' . $_GET['page'];
		}

// form action
if (!isset($_GET['publisher_id'])) {
	$url_action = urlAdminPublisherAdd();
} else {
	$url_action = urlAdminPublisherEdit() . '?publisher_id=' . $_GET['publisher_id'];
}

$url_cancel = urlAdminPublisher();

// Náº¿u Ä‘ang lÃ  edit thÃ¬ láº¥y thÃ´ng tin báº£n ghi theo id vÃ  gá»­i sang view
if (isset($_GET['publisher_id']) && ($_SERVER['REQUEST_METHOD'] != 'POST')) {
	$publisher_info = publisherGetById($_GET['publisher_id']);
}

if (isset($_POST['name'])) 
{
	$publisher_name = $_POST['name'];
} elseif (!empty($publisher_info)) {
	$publisher_name = $publisher_info['name'];
} else {
	$publisher_name = '';
}

if (isset($_POST['keyword'])) 
{
	$publisher_keyword = $_POST['keyword'];
} elseif (!empty($publisher_info)) {
	$publisher_keyword = $publisher_info['keyword'];
} else {
	$publisher_keyword = '';
}

if (isset($_POST['image'])) {
	$publisher_image = $_POST['image'];
} elseif (!empty($publisher_info)) {
	$publisher_image = $publisher_info['image'];
} else {
	$publisher_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$publisher_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($publisher_info) && is_file(DIR_IMAGE . $publisher_info['image'])) {
	$publisher_thumb = img_resize($publisher_info['image'], 100, 100);
} else {
	$publisher_thumb = img_resize('no_image.png', 100, 100);
}

$publisher_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['sort_order'])) {
	$sort_order = $_POST['sort_order'];
} elseif (!empty($publisher_info)) {
	$sort_order = $publisher_info['sort_order'];
} else {
	$sort_order = '';
}

// Nội dung riêng của trang
$web_title = 'Nhà Sản Xuất';
$web_content = "../ui/admin/view/view-publisher-form.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// Được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;