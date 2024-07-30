<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once '../lib/tool.image.php';

$url = '?';

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
 Form Action
 */
if (!isset($_GET['user_id'])) {
	$url_action = urlAdminUserAdd();
} else {
	$url_action = urlAdminUserEdit()."?user_id=".$_GET['user_id'];
}

/*
 Đường link cho nút Cancel
 */
$url_cancel = urlAdminUser();

/*
 Lấy thông tin bản ghi (dựa trên id) và gửi sang bên view
 */
if (isset($_GET['user_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$user_info = userGetById($_GET['user_id']);
}

if (isset($_POST['username'])) {
     $username = $_POST['username'];
} elseif (!empty($user_info)) {
     $username = $user_info['username'];
} else {
     $username = '';
}

if (isset($_POST['password'])) {
     $password = $_POST['password'];
} else {
     $password = '';
}

if (isset($_POST['confirm'])) {
     $confirm_password = $_POST['confirm_password'];
} else {
     $confirm_password = '';
}

if (isset($_POST['fullname'])) {
     $fullname = $_POST['fullname'];
} elseif (!empty($user_info)) {
     $fullname = $user_info['fullname'];
} else {
     $fullname = '';
}

if (isset($_POST['email'])) {
     $email = $_POST['email'];
} elseif (!empty($user_info)) {
     $email = $user_info['email'];
} else {
     $email = '';
}

if (isset($_POST['image'])) {
     $user_image = $_POST['image'];
} elseif (!empty($user_info)) {
     $user_image = $user_info['image'];
} else {
     $user_image = '';
}

if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) {
     $user_thumb = img_resize($_POST['image'], 100, 100);
} elseif (!empty($user_info) && $user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
     $user_thumb = img_resize($user_info['image'], 100, 100);
} else {
     $user_thumb = img_resize('no_image.png', 100, 100);
}
		
$user_placeholder = img_resize('no_image.png', 100, 100);

if (isset($_POST['status'])) {
     $user_status = $_POST['status'];
} elseif (!empty($user_info)) {
     $user_status = $user_info['status'];
} else {
     $user_status = 0;
}		

// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-user-form.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;
