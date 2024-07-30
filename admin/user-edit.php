<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.user.php';
include_once 'user-validate.php';

checkLogin();

// Nếu user gửi form lên
// toàn bộ dữ liệu chỉnh sửa được lưu trong biến mảng $_POST
// nếu username và password để trống thì giá trị cũ được giữ nguyên !!!
if ($_SERVER['REQUEST_METHOD'] == "POST" && validateEdit() && validateForm()) {
	// Sửa user
	userEdit($_GET['user_id'], $_POST);
	
	userInfoReset(); // đề phòng trường hợp user admin sửa thông tin của chính mình

	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã sửa thành công thông tin người dùng quản trị !';

	// Điều hướng tới trang danh mục DANH_MUC
	// có phân trang và sắp xếp
	$url = '';
	if (isset ($_GET['sort'])) {
		$url .= '&sort=' . $_GET['sort'];
	}

	if (isset ($_GET['order'])) {
		$url .= '&order=' . $_GET['order'];
	}

	if (isset ($_GET['page'])) {
		$url .= '&page=' . $_GET['page'];
	}

	header("location: /" . APP . "/admin/user.php?token=" . $_SESSION['TOKEN'] . $url);
}

$form_title = 'Sửa thông tin nhân viên quản trị';
$web_title = 'Sửa User';
include_once 'user-form.php';