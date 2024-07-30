<?php

include_once(DIR_APP."lib/table/table.user.php");	// Thư viện hàm xử lý thông tin quản trị viên
include_once(DIR_APP."lib/table/table.customer.php");	// Thư viện hàm xử lý thông tin khách hàng
include_once(DIR_APP."lib/tool.image.php");	// Thư viện hàm xử lý ảnh.

/**
 * Các hàm tiện ích phân trang, thiết lập thông tin 
 * đăng nhập người dùng v.v...
 */

/**
 * Tải toàn bộ thông tin cấu hình hệ thống (lưu trong bảng `setting` )
 * vào trong mảng kết hợp: global $config.
 * load_settings() is deprecated since 2017.05.06 11h39
 */
function load_settings()
{
	// Khởi tạo đối tượng chứa thông tin cấu hình hệ thống
	global $settings;
	$settings = array();

	// Tải các settings từ cơ sở dữ liệu
	$rs = db_q("SELECT * FROM `setting`");


	foreach ($rs as $setting)
	{
		if (!$setting['serialized'])
		{
			$settings[$setting['key']]=$setting['value'];
		} else {
			$settings[$setting['key']]=unserialize($setting['value']);
		}
	}
}

/**
 * Tải một thông tin cấu hình hệ thống theo khóa (key)
 */
function settings($key)
{
	global $settings;	
	return $settings[$key];
}

/**
 * Phân trang
 */
function paginate($_total=0, $_page=1, $_limit=20, $_url='', $_num_links=8)
{

	$total = 0;	// Tổng số mục cần phân trang
	$totalPages = 0;
	$page = 1;	// số thứ tự của trang hiện tại
	$limit = 20; // số lượng mục trên một trang
	$num_links = 8;	// số lượng đường link trong các đường link phân trang (number of active links in the paging links
	$url = '';
	$text_first = '|&lt;'; // Chạy đến trang đầu tiên
	$text_last = '&gt;|'; // chạy đến trang cuối cùng
	$text_next = '&gt;';	// trang tiếp theo
	$text_prev = '&lt;'; // trang trước đó
	
	$pageStart = 1; // Chỉ số của phần tử đầu tiên trên trang hiện tại
	$pageEnd = 20;  // Chỉ số của phần tử cuối cùng trên trang hiện tại

	// Khởi tạo các thông số phân trang
	// (Initializing pagination's parameters)
	{
		$total = $_total;
		$page = $_page;
		$limit = $_limit;
		$url = empty($_url) ? '' : $_url.'&page={page}';
		$num_links = $_num_links;
	
		$totalPages = floor( $_total / $_limit ) + ( ($_total % $_limit == 0 ) ? 0 : 1);
	
		if ( $total )
		{
			$pageStart = ($page - 1) * $limit + 1;
		}
	
		// Nếu như trang cuối cùng ít hơn số phần tử bị giới hạn trên trang
		// If the last page has less than the limited items per page
		if ( ($page * $limit) > $total)
		{
			$pageEnd = $total;
		}
		else	// the last page has perfectly the limited items per page
		{
			$pageEnd = $page * $limit;
		}
	
	}// kết thúc khối lệnh
	
	/**
	 * Trả về đoạn mã HTML có chứa nội dung phân trang (mặc định sử dụng Bootstrap CSS).
	 * Có thể phải tùy biến html,css của phần tử html chứa nội dung phân trang.
	 * @return html code representing pagination controls
	 */
	{
		$num_pages = ceil($total / $limit);
	
		$url = str_replace('%7Bpage%7D', '{page}', $url);
	
		// Chú ý: Khi sử dụng các mẫu thiết kế khác thì phải sửa
		// chỗ này cho phù hợp với html và css của mẫu mới.
		$output = '<ul class="pagination">'; // bắt đầu html phân trang
	
		if ($page > 1) 
		{
			$output .= '<li><a href="' . str_replace('{page}', 1, $url) . '">' . $text_first . '</a></li>';
			$output .= '<li><a href="' . str_replace('{page}', $page - 1, $url) . '">' . $text_prev . '</a></li>';
		}
	
		if ($num_pages > 1) 
		{
			if ($num_pages <= $num_links) 
			{
				$start = 1;
				$end = $num_pages;
			} 
			else 
			{
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
	
				if ($start < 1) 
				{
					$end += abs($start) + 1;
					$start = 1;
				}
	
				if ($end > $num_pages) 
				{
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}
	
			for ($i = $start; $i <= $end; $i++) 
			{
				if ($page == $i) 
				{
					$output .= '<li class="active"><span>' . $i . '</span></li>';
				} 
				else 
				{
					$output .= '<li><a href="' . str_replace('{page}', $i, $url) . '">' . $i . '</a></li>';
				}
			}
		}
	
		if ($page < $num_pages) 
		{
			$output .= '<li><a href="' . str_replace('{page}', $page + 1, $url) . '">' . $text_next . '</a></li>';
			$output .= '<li><a href="' . str_replace('{page}', $num_pages, $url) . '">' . $text_last . '</a></li>';
		}
	
		$output .= '</ul>';	// kết thúc html phân trang
	
		global $web_pagination_controls; 
		$web_pagination_controls = ($num_pages > 1) ? $output : '';
		
		global $web_pagination_results;
		$web_pagination_results = sprintf("Hiển thị từ %s đến %s của %s (%s Trang)",
									$pageStart,
									$pageEnd,
									$total,
									$totalPages);
		
	}// kết thúc khối lệnh
	
	
}// kết thúc hàm phân trang


/**
 * Kiểm tra xem quản trị viên đã đăng nhập vào hệ thống chưa,
 * trước khi cho phép họ tiếp cận các chức năng quan trọng của hệ thống
 * (ví dụ: thêm, sửa, xóa...)
 * Đồng bộ với admin-authentication.php, layout login admin ở thông tin điều hướng
 * redirect url
 */
function checkLogin()
{
	if (!isset($_SESSION['USER_LOGGED'])) 
	{
		// @todo assign token to url
		
		$token = isset($_GET['token']) ? "&token=".$_GET['token'] : "";
		
		// @todo
		// Điều hướng sang trang đăng nhập của phần quản trị
	    header("location: ".urlAdmin()."?ru=".urlencode($_SERVER["REQUEST_URI"]).$token);
	}
}

function checkLoginAdmin()
{
	return checkLogin();	
}

function checkLoginHome()
{
	if (!isset ($_SESSION['CUS_LOGGED']))
	{
		// @todo assign token to url

		$token = isset($_GET['token']) ? "&token=".$_GET['token'] : "";

		// @todo
		// Điều hướng sang phần đăng nhập trang chủ
		header ("location: ".urlLogin()."?ru=".urlencode($_SERVER["REQUEST_URI"]).$token);
	}
}

/** 
 * Các hàm tiện ích truy cập nhanh thông tin của user đang đăng nhập hiện tại 
 */
function userFullname()
{
	return $_SESSION['USR_FULLNAME'];
}

function userName()
{
	return $_SESSION['USR_USERNAME'];
}

function userImg()
{
	return $_SESSION['USR_IMG'];
}

function userId()
{
	return $_SESSION['USER_LOGGED'];
}

// đồng bộ với admin-authentication.php
function userInfoReset()
{
	
	
	$aUser = userGetById($_SESSION['USER_LOGGED']);
    // @todo load roles and permissions if needed
    
    // Tên đầy đủ của user đăng nhập
	$_SESSION['USR_FULLNAME'] = $aUser['fullname'];
		
	// Ảnh đại diện (Profile Image)
	if (is_file(DIR_IMAGE . $aUser['image'])) { 
		$_SESSION['USR_IMG'] = img_resize($aUser['image'], 45, 45);
	} else {
		$_SESSION['USR_IMG'] = img_resize('no_image.png', 45, 45);
	}
}

/**
 * Các hàm tiện ích truy cập nhanh thông tin của khách hàng đang đăng nhập
 */
function cusFullname()
{
	return $_SESSION['CUS_FULLNAME'];
}

function cusEmail()
{
	return $_SESSION['CUS_EMAIL'];
}

function cusImg()
{
	return $_SESSION['CUS_IMG'];
}
// đồng bộ với cus-authentication.php
function cusInfoReset()
{

	$aCustomer = customerGetById($_SESSION['CUS_LOGGED']);
    
    // Tên đầy đủ của khách hàng đăng nhập
    $_SESSION['CUS_EMAIL'] = $aCustomer['email'];
	$_SESSION['CUS_FULLNAME'] = $aCustomer['fullname'];
		
	// Ảnh đại diện (Profile Image)
	if (is_file(DIR_IMAGE . $aCustomer['image'])) { 
		$_SESSION['CUS_IMG'] = img_resize($aCustomer['image'], 45, 45);
	} else {
		$_SESSION['CUS_IMG'] = img_resize('no_image.png', 45, 45);
	}
	
    unset($_SESSION['FAILED_LOGINS']);
}

// Kiểm tra xem khách hàng đã đăng nhập vào hệ thống hay chưa ?
// @return boolean
function customerIsLoggedIn()
{
	return isset($_SESSION['CUS_LOGGED']);
}

function customerLoggedIn()
{
	return customerIsLoggedIn();
}

// Trả về tên của hệ thống thông tin
// ví dụ: iShop, shop quần áo, cửa hàng hoa v.v...
function systemName()
{
	return settings('config_name');
}

// Trả về tên của hệ thống thông tin
// ví dụ: iShop, shop quần áo, cửa hàng hoa v.v...
function storeName()
{
	return systemName();
}

function storeAddress()
{
	return settings('config_address');
}

function storeEmail()
{
	return settings('config_email');
}

function storeUrl()
{
	return settings('config_url');
}

// Trả về đường dẫn bán tuyệt đối đến ảnh logo của hệ thống
function systemLogo()
{
	return URL_IMAGE.settings('config_logo');
}
function systemIcon()
{
	return URL_IMAGE.settings('config_icon');
}
function systemImage()
{
	return URL_IMAGE.settings('config_image');
}

function storeLogo()
{
	return systemLogo();
}
function storeIcon()
{
	return systemIcon();
}
function storeImage()
{
	return systemImage();
}

function storeTelephone()
{
	
	return settings('config_telephone');
}

function checkFileLayout($layout, $content=NULL)
{
	
	// Nếu $layout không rỗng, và cũng không phải là
	// file trên hệ thống thì báo lỗi ngay và dừng chương trình
	if (!empty($layout) && !is_file($layout) )
	{
		echo '<b style="color: red;">Error!-File not found:</b>'.$layout;
		die();
	}
	// Nếu $content không rỗng, và cũng không phải là 
	// file trên hệ thống thì chỉ cảnh báo.
// 	if (!empty($content) && !is_file($content) )
// 	{
// 		echo '<b style="color: red;">Error-Content file not found!</b>'.$content;
// 	}
	
	// còn các tình huống bị rỗng thì bỏ qua, ko làm gì cả.
}