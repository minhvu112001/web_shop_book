<?php
include_once 'configs.php';


$url_redirect = isset ($_SESSION['USER_LOGGED']) ? urlAdminBook() : urlAdminLogin(); 

// Nếu như user đã đăng nhập vào rồi
// thì điều hướng vào phần quản trị
// (@todo: điều hướng vào url mà họ yêu cầu trước đó)

// Nếu như đăng nhập vào rồi thì điều hướng
// sang trang dashboard
// còn không thì điều hướng sang
header ("location: ".$url_redirect);
die();
