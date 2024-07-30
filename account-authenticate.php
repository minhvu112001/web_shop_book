<?php
include_once 'configs.php';
include_once 'lib/table/table.customer.php';

// Bắt các thông tin gửi lên từ form đăng nhập
$email = strtolower(trim($_POST['email']));
$password = trim($_POST['password']);
	
// Thực thi quá trình xác thực danh tính của user	
$customer_id = customerVerifyLogin($email,$password);
// @todo Clear session files older than 72 hours
	
// Các tình huống username không hợp lệ.
switch ($customer_id) 
{
	case -1:
    	$errLabel = 'Khách hàng không tồn tại';
        break;
    case -2:
        $errLabel = 'Mật khẩu không đúng';
        break;
	case -3:
		$errLabel = 'Khách hàng chưa được kích hoạt'; //The user is inactive
        break;
    case -4:
        $errLabel = 'Khách hàng đã hết hạn sử dụng'; //The Due date is finished
        break;
}
    
if ( !isset($customer_id) ) 
{
	$customer_id = -1;
    $errLabel = 'Khách hàng không tồn tại';
}
    
// Nếu đăng nhập thất bại
if (!isset($customer_id) || $customer_id < 0) 
{ 
		if (isset($_SESSION['CUS_FAILED_LOGINS'])) 
		{	// set in login.php
        	$_SESSION['CUS_FAILED_LOGINS']++;
        }
        
        // Hiện lại thông tin trên form để user đỡ phải nhập lại
        $_SESSION['FAILED_EMAIL'] = $email;
        $_SESSION['FAILED_PASSWORD'] = $password;
		
		// Gửi thông báo lỗi sang tầng giao diện html
		$_SESSION["ERROR_TEXT"] = $errLabel;
		
		// Điều hướng quay trở lại form đăng nhập  
		header ("location: ".urlLogin());
        die;
	}
	
	/* 
	 Các khách hàng đăng nhập thành công  
	 @synchronized with logout.php
	  Session Token: Định danh của phiên đăng nhập: chuỗi mã ký tự
     duy trì giao tiếp (phiên đăng nhập) 
     giữa trình duyệt (client browser) và máy chủ (web server)
	 */
	
	$_SESSION['CUS_LOGGED']  = $customer_id;
    
    cusInfoReset(); 
    
    // Điều hướng user tới trang được yêu cầu ngay trước lúc đăng nhập...
    if ( isset($_POST['ru']) ) 
    {
		$sLocation = $_POST['ru'];	
	}
	else // ...hoặc tới trang mặc định 
	{
		$sLocation = urlHome();	
	}
	header ("location: $sLocation");
