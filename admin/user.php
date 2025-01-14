<?php
// cấu hình hệ thống
include_once '../configs.php';

checkLogin(); // Phải đăng nhập và @todo phải có quyền

// thư viện hàm
include_once '../lib/table/table.user.php';
include_once '../lib/tool.image.php';

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt (url),
 * Ví dụ:
 * 		http://localhost:82/admin/user?sort=username&order=DESC&page=2
 * Mặc định, nếu không bắt được thì:
 * Sắp xếp theo cột sort = name
 * Trật tự sắp xếp order = ASC (tăng dần)
 * Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'username';
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page = isset($_GET['page']) ? $_GET['page'] : 1;

/*
 Điều hướng ruột bánh mỳ (Breadcrumbs Navigation)
 Gán các đường dẫn bán tuyệt đối vào điều hướng.
 */
$url = '';

$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

/*
 Truy vấn cơ sở dữ liệu
 */
$users = array();

// Tiêu chí truy vấn sql
$filter_data = array(
	'sort'  => $sort,
	'order' => $order,
	'start' => ($page - 1) * settings('config_limit_admin'),
	'limit' => settings('config_limit_admin')
);

// Thực hiện truy vấn
$total_user = userGetTotal();
$results = userGetAll($filter_data);

// Thêm các thông tin cần thiết khác vào kết quả truy vấn
// Gán các đường link vào các nút edit, delete
// để khi bấm vào thì thao tác/can thiệp đúng item theo id
foreach ($results as $result) 
{
	// Xử lý đường dẫn ảnh đại diện trước khi gửi sang view html
	if (is_file(DIR_IMAGE . $result['image'])) 
	{
		$user_thumb = img_resize($result['image'], 100, 100);
	} 
	else 
	{
		$user_thumb = img_resize('no_image.png', 100, 100);
	}
	
	$users[] = array(
		'user_id'    => $result['user_id'],
		'username'   => $result['username'],
		'thumb' => $user_thumb,
		'status'     => ($result['status'] ? 'Cho phép' : 'Không cho phép'),
		'date_added' => date('d/m/Y', strtotime($result['date_added'])),
		'edit'       => urlAdminUserEdit()."?user_id=".$result['user_id'].$url
	);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if (isset($_POST['selected'])) {
	$selected = (array)$_POST['selected'];
} else {
	$selected = array();
}

/*
 Tạo đường link cho các cột kết quả ở phía view. Bấm vào đường link nào thì sắp xếp theo cột đấy.
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 */
$url  = '';
$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

$sort_username   = urlAdminUser()."?sort=username".$url;
$sort_status     = urlAdminUser()."?sort=status".$url;
$sort_date_added = urlAdminUser()."?sort=date_added".$url;

/*
 Phân Trang
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Ví dụ:
 	http://localhost:82/admin/user?sort=sort_order&order=DESC&page=2
 	http://localhost:82/admin/user?sort=name&order=ASC&page=2
 	http://localhost:82/admin/user?
 	&page=2
 */
$url  = urlAdminUser().'?';
$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này 
// được thực hiện bởi đối tượng thuộc lớp Pagination

paginate($total_user, $page,settings('config_limit_admin'), $url);

// Nội dung riêng của trang...
$web_title = 'Nhân Viên';
$web_content = DIR_UI."admin/view/view-user-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_USER;

// ...được đặt vào bố cục chung của toàn website.
include_once FILE_LAYOUT_ADMIN;
