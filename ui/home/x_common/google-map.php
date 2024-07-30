<?php $arr = explode('\\', __FILE__); include_once($_SERVER["DOCUMENT_ROOT"].'/'.$arr[3].'/configs.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php $web_title = "Bản Đồ"; ?>
<!-- Thư viện css,javascript cơ sở -->
<?php include_once(DIR_APP."/themes/home/layout-home-head.php");?>
</head>
<body>
	<div id="google-map" style="height: 450px;width:100%;position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>
</body>
</html>