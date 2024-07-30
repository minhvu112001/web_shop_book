<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.banner.php';

// @todo use ternary operator
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($_GET['order'])) {
			$order = $_GET['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}

$url = '';

$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page=' . $_GET['page']   : "";		
		
// link gửi sang giao diện html		
$url_delete = urlAdminBannerDelete();

/*
 Truy vấn cơ sở dữ liệu
 */
$banners = array();

$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * settings('config_limit_admin'),
			'limit' => settings('config_limit_admin')
);

$banner_total = bannerGetTotal();

$results = bannerGetAll($filter_data);

foreach ($results as $result) 
{
			$banners[] = array(
				'banner_id' => $result['banner_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? 'Cho phép' : 'Không cho phép'),
				'edit'      => urlAdminBannerEdit() . '?banner_id=' . $result['banner_id'] . $url
			);
}

		if (isset($_POST['selected'])) {
			$selected = (array)$_POST['selected'];
		} else {
			$selected = array();
		}

/*
 Tạo đường link cho các cột kết quả ở phía view
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 @todo Add session token like OpenCart
 */
$url = '?';
$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC';
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : "";

$sort_name = urlAdminBanner() . '?sort=name' . $url;
$sort_status = urlAdminBanner() . '?sort=status' . $url;

// Phân Trang
$url = urlAdminBanner().'?';
$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";		
		
paginate($banner_total, $page,settings('config_limit_admin'), $url);

// Nội dung riêng của trang...
$web_title = 'Banners';
$web_content =  "../ui/admin/view/view-banner.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_BANNER;

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// ...được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;