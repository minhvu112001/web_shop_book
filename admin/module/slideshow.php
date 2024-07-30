<?php

include_once '../../configs.php';
include_once '../../lib/table/table.module.php';
include_once '../../lib/table/table.banner.php';
include_once '../module-validate.php';

		if (($_SERVER['REQUEST_METHOD'] == "POST") && validateModule()) {
			if (!isset($_GET['module_id'])) {
				moduleAdd('slideshow', $_POST);
			} else {
				moduleEdit($_GET['module_id'], $_POST);
			}
			
			$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa thành công module slideshow';

			header ("location: ".urlAdminModule());
		}

		$breadcrumbs = array();

		$breadcrumbs[] = array(
			'text' => 'Trang chủ',
			'href' => urlAdminDashboard()
		);

		$breadcrumbs[] = array(
			'text' => 'Module',
			'href' => urlAdminModule()
		);


		if (!isset($_GET['module_id'])) {
			$breadcrumbs[] = array(
				'text' => 'Slideshow',
				'href' => urlAdminModuleSlideshow()
			);
		} else {
			$breadcrumbs[] = array(
				'text' => 'Slideshow',
				'href' => urlAdminModuleSlideshow() . '?module_id=' . $_GET['module_id']
			);			
		}

		if (!isset($_GET['module_id'])) {
			$url_action = urlAdminModuleSlideshow();
		} else {
			$url_action = urlAdminModuleSlideshow() . '?module_id=' . $_GET['module_id'];
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
		
		// Độ rộng ảnh banner
		if (isset($_POST['width'])) {
			$width = $_POST['width'];
		} elseif (!empty($module_info)) {
			$width = $module_info['width'];
		} else {
			$width = '';
		}	
		
		// Chiều cao ảnh banner			
		if (isset($_POST['height'])) {
			$height = $_POST['height'];
		} elseif (!empty($module_info)) {
			$height = $module_info['height'];
		} else {
			$height = '';
		}			
		
		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		} elseif (!empty($module_info)) {
			$status = $module_info['status'];
		} else {
			$status = '';
		}
		
$web_title = 'Module-Slideshow';

// Nội dung riêng của trang:
$web_content = "../../ui/admin/view/view-module-slideshow.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;

