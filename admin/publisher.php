<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.publisher.php';

checkLogin();

/*
 Bắt các tham số lọc kết quả tìm kiếm yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên.
 */
//$filter_name     = isset($_REQUEST['filter_name']) ? $_REQUEST['filter_name'] : null;

/*
 Bắt các tham số phân trang và thứ tự sắp xếp yêu cầu từ phía trình duyệt,
 các tham số này có thể nằm trong url hoặc form gửi lên. 
 Ví dụ:
  		http://localhost:82/admin/catalog/category?sort=sort_order&order=DESC&page=2
  Mặc định, nếu không bắt được thì:
  Sắp xếp theo cột sort = name
  Trật tự sắp xếp order = ASC (tăng dần)
  Trang hiện thời = 1 (trang đầu tiên trong phân trang)
 */
$sort  = isset($_GET['sort'])  ? $_GET['sort']  : "";
$order = isset($_GET['order']) ? $_GET['order'] : "ASC";
$page  = isset($_GET['page'])  ? $_GET['page']  : 1;

$url = '?';

//if (isset($_GET['filter_name'])) {
//	$url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
//}


$url .= isset($_GET['sort'])  ? '&sort=' . $_GET['sort']   : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
$url .= isset($_GET['page'])  ? '&page=' . $_GET['page']   : "";

if($url=='?') $url = '';

// link gửi sang giao diện html
$url_delete = urlAdminPublisherDelete().$url;

/*
 Truy vấn cơ sở dữ liệu
 */
$publishers = array();

// tiêu chí truy vấn
$filter_data = array(
	'sort'            => $sort,
	'order'           => $order,
	'start'           => ($page - 1) * settings('config_limit_admin'),
	'limit'           => settings('config_limit_admin')		// 20 phần tử trên trang, xem file sys.functions.php
);

$publisher_total = publisherGetTotal();

$results = publisherGetAll($filter_data);

foreach ($results as $result) 
{
	
			$publishers[] = array(
				'publisher_id' => $result['publisher_id'],
				'image' => is_file(DIR_IMAGE . $result['image']) ? img_resize($result['image'], 40, 40) : img_resize('no_image.png', 40, 40),  
				'name'            => $result['name'],
				'sort_order'      => $result['sort_order'],
				'edit'            => urlAdminPublisherEdit() . '?publisher_id=' . $result['publisher_id']
			);
}

// Các mục được chọn để xóa
// Khi việc xóa gặp trục trặc (ví dụ: ko có quyền, v.v..), thì các
// ô checkbox được giữ nguyên, người dùng không phải tích lại
if ( isset($_POST['selected']))  
{ 
	$selected = (array)$_POST['selected'];
}
else {
	$selected = array();
}

/*
 Tạo đường link cho các cột kết quả ở phía view
 Mỗi đường link chứa tham số về trật tự và lọc khi truy vấn,
 vì vậy khi user bấm vào tên cột, kiểu sắp xếp khác sẽ được thực hiện
 Nếu url mà user đang xem là ASC(tăng) thì sẽ bị đổi lại thành DESC (giảm)
 và ngược lại.
 */
$url = '';

if (isset($_GET['filter_name'])) {
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

$url .= ($order == 'ASC') ? '&order=DESC' : '&order=ASC'; // the same as above if---else---if
$url .= isset($_GET['page']) ? '&page=' . $_GET['page'] : '';

/*
 Bấm vào đường link nào thì sắp xếp theo cột đấy.
 Ví dụ: sắp xếp theo name, model, price, ...
 */
$sort_name       = urlAdminPublisher() . '?sort=name' . $url;
$sort_sort_order = urlAdminPublisher() . '?sort=sort_order' . $url;

/*
 Khởi tạo đối tượng phân trang (Pagination Object).
 Trong đường link phân trang phải có tham số:
 - page: trang hiện tại
 có thể có:
 - sort: sắp xếp theo cột nào (mặc định = name)
 - order: trật tự sắp xếp là gì (mặc định = ASC)
 Exam:
 */
$url = '?';

if (isset($_GET['filter_name'])) {
     $url .= '&filter_name=' . urlencode(html_entity_decode($_GET['filter_name'], ENT_QUOTES, 'UTF-8'));
}

$url .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "";
$url .= isset($_GET['order']) ? '&order=' . $_GET['order'] : "";
// Không thêm thông tin phân trang vào $url vì việc này 
// được thực hiện bởi đối tượng thuộc lớp Pagination

paginate($publisher_total, $page,settings('config_limit_admin'), urlAdminPublisher().$url);

// Nội dung riêng của trang...
$web_title = "Nhà Xuất Bản";
$web_content = "../ui/admin/view/view-publisher-list.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_PUBLISHER; // ACTIVE_PAGE_ADMIN_PUBLISHER

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// ...được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;
