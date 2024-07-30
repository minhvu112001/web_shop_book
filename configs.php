<?php
/*	
 File:    configs.php
 Tóm tắt: Cấu hình hệ thống.
 Mô tả:   Cấu hình các thông tin:
 - máy chủ cơ sở dữ liệu, 
 - thư mục chứa mã nguồn ứng dụng, 
 - thư mục chứa các file layout của trang chủ/trang quản trị/trang đăng nhập quản trị,
 
 Nên dùng lệnh include_once() thay vì các lệnh khác như include(), require(), require_once()
 bởi vì lệnh này chỉ gọi thư viện một lần, và nếu có lỗi thì nó cũng chỉ cảnh báo
 và script vẫn chạy tiếp. Hơn nữa lệnh này gần với #include của C.
 
 XAMPP Control Panel v3.2.1
 PHP 5.5.6
 
 Cả Windows & Linux đều hỗ trợ dấu phân cách thư mục '/'
 nên ko cần lo lắng về việc chuyển đổi qua lại. Ví dụ:
 	C:\xampp\php\ext = C:/xampp/php/ext
 
 http://code.stephenmorley.org/articles/xampp-version-history-apache-mysql-php/
 https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/
 
 */

// Thiết lập chế độ hiển thị lỗi.
error_reporting(E_ALL);
error_reporting(1);
//$startingTime = microtime(true);

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'web_book');   
define('DB_USER', 'root');		
define('DB_PASS', '');			  
								
								
									
// Kho Ảnh
define('FOLDER_IMAGE', 'images');

// Kho Giao Diện: 
define('PATH_UI', 'ui/'); 
// Giao diện trang chủ...
define('PATH_HOME_THEMES', 'home/opencart_0000/');//46247, 50677, 0000, 58898, 45570
// Giao diện trang quản trị:
define('PATH_ADMIN_THEMES', 'admin/flat_000/');
// Giao diện trang đăng nhập quản trị:
define('PATH_ADMINLOGIN_THEMES', 'adminlogin/flat_000/');// @xem adminlogin/flat_005 để biết cách cấu hình hình nền cho trang
														  // @xem adminlogin/flat_006 để biết cách hiện ảnh của user vừa thoát.

// Thư mục chứa mã nguồn ứng dụng.
// ví dụ: nếu như __FILE__ = 'C:\xampp\htdocs\web\configs.php'
// thì APP = 'web'
$arr = explode('\\', __FILE__);
define('APP', $arr[3]);


// Địa chỉ tương đối của web 
define( 'URL_APP', '/'.APP.'/');
define( 'PATH_APP', '/'.APP.'/');
// Đường dẫn tuyệt đối đến thư mục mã nguồn ứng dụng.
// ví dụ: 	C:/xampp/htdocs/web-book/
define( 'DIR_APP', $_SERVER["DOCUMENT_ROOT"].PATH_APP);

// Đường dẫn tuyệt đối đến thư mục ảnh của toàn bộ hệ thống
// Ví dụ: C:/xampp/htdocs/web/image
define('DIR_IMAGE', DIR_APP . FOLDER_IMAGE."/");
define('URL_IMAGE', URL_APP . FOLDER_IMAGE."/");

// Đường dẫn tuyệt đối đến giao diện ui html
define( 'DIR_UI', DIR_APP . PATH_UI);
// Địa chỉ web tương đối đến giao diện ui html
define( 'URL_UI', URL_APP . PATH_UI);

// Khởi tạo phiên kết nối client (máy khách) <-> server (máy chủ) 
session_start();

// Khai báo các biến toàn cục (global variables),
// các biến này được truy cập bởi mọi trang php
global $settings;
global $db;
global $web_title; // tựa đề của trang
global $web_head; // css, javascript thêm vào của một trang cụ thể
global $web_content; // nội dung riêng của từng trang
global $web_pagination_controls; // phân trang
global $web_pagination_results;
global $active_page_admin; // trang hiện thời gắn liền với menu bị nhấp chuột.

// Tải các hàm toàn cục (global functions) để xử lý các tác vụ chung
// như truy vấn cơ sở dữ liệu, phân trang, giỏ hàng, dữ liệu phiên v.v...)
// các hàm này được gọi bởi hầu hết các trang php 
include_once 'lib/db.php';
include_once 'lib/system.urls.php';
include_once 'lib/system.functions.php';
include_once 'lib/tool.image.php';
include_once 'lib/active-page.php';
// Tải các thư viện php của bên thứ 3, thư viện hệ thống v.v...
include_once 'lib/thirdparty/antnee/passwordLib.php'; // mã hóa (mật khẩu)
include_once 'lib/thirdparty/opencart/helper/utf8.php'; // xử lý chuỗi ký tự Unicode
// Tải các thành phần chung nhất được sử dụng thường xuyên bởi hầu hết các
// trang trong hệ thống: danh mục loại sản phẩm, giỏ hàng, các hàm xử lý ảnh.
include_once 'lib/table/table.category.php';
include_once 'cart-session.php';

// Kết nối cơ sở dữ liệu.
db_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Tải thông tin cài đặt hệ thống
load_settings();

// Mặc định ban đầu layout của từng trang chưa có nội dung.
// Tránh để $web_content bị null vì các file bố cục giao diện: layout*.php
// sẽ bị ngắt ở lệnh: include_once( $web_content )
$web_head = '';
$web_title = storeName();
$web_content = DIR_UI."home/view-content.php";

// ...đường dẫn tuyệt đối, địa chỉ web tương đối,
// đường dẫn tuyệt đối đến file layout giao diện trang chủ
define( 'DIR_UI_HOME_THEMES', DIR_UI.PATH_HOME_THEMES); // Gọi bởi tầng quy tắc nghiệp vụ php
define( 'URL_UI_HOME_THEMES', URL_UI.PATH_HOME_THEMES);	// Gọi bởi tầng trình diễn ui html
define( 'FILE_LAYOUT_HOME',  DIR_UI_HOME_THEMES.'layout.php');

// Đường dẫn tuyệt đối đến file layout giao diện trang quản trị
define( 'DIR_UI_ADMIN_THEMES', DIR_UI.PATH_ADMIN_THEMES); // Gọi bởi tầng quy tắc nghiệp vụ php
define( 'URL_UI_ADMIN_THEMES', URL_UI.PATH_ADMIN_THEMES);	// Gọi bởi tầng trình diễn ui html
define( 'FILE_LAYOUT_ADMIN', DIR_UI.PATH_ADMIN_THEMES.'layout-admin.php'); // không sử dụng đuôi phtml vì khi test riêng layout nó không chạy

// Đường dẫn tuyệt đối đến file layout giao diện đăng nhập trang quản trị
define( 'URL_UI_ADMINLOGIN_THEMES', URL_UI.PATH_ADMINLOGIN_THEMES);	// Gọi bởi tầng trình diễn ui html
define( 'FILE_LAYOUT_ADMIN_LOGIN', DIR_UI.PATH_ADMINLOGIN_THEMES.'layout-adminlogin.php');

// Báo lỗi nếu người dùng gõ vào địa chỉ url không hợp lệ
// hoặc họ truy cập vào tài nguyên không được phép.
// Khi đó người dùng bị điều hướng sang địa chỉ:
//		http://localhost:82/web/configs.php?failed=1
if (isset($_GET['failed']) && $_GET['failed']) 
{
	include_once 'error.php';
}

