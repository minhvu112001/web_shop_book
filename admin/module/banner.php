<?php
include_once '../../configs.php';
include_once '../../lib/table/table.module.php';
include_once '../../lib/table/table.banner.php';
include_once '../module-validate.php';

		if (($_SERVER['REQUEST_METHOD'] == "POST") && validateModule()) 
		{
			if (!isset($_GET['module_id'])) {
				moduleAdd('banner', $_POST);
			} else {
				moduleEdit($_GET['module_id'], $_POST);
			}
			
			$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa thành công module banner';

			header ("location: ".urlAdminModule());
		}

		
		if (!isset($_GET['module_id'])) {
			$url_action = urlAdminModuleBanner();
		} else {
			$url_action = urlAdminModuleBanner() . '?module_id=' . $_GET['module_id'];
		}
		
		$url_cancel = urlAdminModule();
		
		if (isset($_GET['module_id']) && ($_SERVER['REQUEST_METHOD'] != "POST")) {
			$module_info = moduleGetById($_GET['module_id']);
		}
		
		if (isset($_POST['name'])) {
			$module_name = $_POST['name'];
		} elseif (!empty($module_info)) {
			$module_name = $module_info['name'];
		} else {
			$module_name = '';
		}
				
		if (isset($_POST['banner_id'])) {
			$banner_id = $_POST['banner_id'];
		} elseif (!empty($module_info)) {
			$banner_id = $module_info['banner_id'];
		} else {
			$banner_id = '';
		}
		
		$banners = bannerGetAll();
		
		if (isset($_POST['width'])) {
			$banner_width = $_POST['width'];
		} elseif (!empty($module_info)) {
			$banner_width = $module_info['width'];
		} else {
			$banner_width = '';
		}	
			
		if (isset($_POST['height'])) {
			$banner_height = $_POST['height'];
		} elseif (!empty($module_info)) {
			$banner_height = $module_info['height'];
		} else {
			$banner_height = '';
		}			
		
		if (isset($_POST['status'])) {
			$banner_status = $_POST['status'];
		} elseif (!empty($module_info)) {
			$banner_status = $module_info['status'];
		} else {
			$banner_status = '';
		}
		
$web_title = 'Module-Banner';

// Nội dung riêng của trang:
$web_content = "../../ui/admin/view/view-module-banner.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;
