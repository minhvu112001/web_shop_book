<?php
// Cấu hình hệ thống
include_once '../configs.php';
// Thư viện hàm
include_once '../lib/table/table.author.php';
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
if (!isset($_GET['author_id'])) {
	$url_action = urlAdminAuthorAdd();
} else {
	$url_action = urlAdminAuthorEdit() . '?author_id=' . $_GET['author_id'];
}

$url_cancel = urlAdminAuthor();

// Náº¿u Ä‘ang lÃ  edit thÃ¬ láº¥y thÃ´ng tin báº£n ghi theo id vÃ  gá»­i sang view
if (isset($_GET['author_id']) && ($_SERVER['REQUEST_METHOD'] != 'POST')) {
	$author_info = authorGetById($_GET['author_id']);
}

if (isset($_POST['name'])) 
{
	$author_name = $_POST['name'];
} elseif (!empty($author_info)) {
	$author_name = $author_info['name'];
} else {
	$author_name = '';
}

if (isset($_POST['description'])) 
{
	$author_description = $_POST['description'];
} elseif (!empty($author_info)) {
	$author_description = $author_info['description'];
} else {
	$author_description = '';
}

if (isset($_POST['image'])) {
	$author_image = $_POST['image'];
} elseif (!empty($author_info)) {
	$author_image = $author_info['image'];
} else {
	$author_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
	$author_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($author_info) && is_file(DIR_IMAGE . $author_info['image'])) {
	$author_thumb = img_resize($author_info['image'], 100, 100);
} else {
	$author_thumb = img_resize('no_image.png', 100, 100);
}

$author_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['sort_order'])) {
	$sort_order = $_POST['sort_order'];
} elseif (!empty($author_info)) {
	$sort_order = $author_info['sort_order'];
} else {
	$sort_order = '';
}

// Nội dung riêng của trang
$web_title = 'Tác Giả';
$web_content = "../ui/admin/view/view-author-form.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// Được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;