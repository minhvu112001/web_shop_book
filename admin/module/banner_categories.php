<?php

include_once '../../configs.php';
include_once '../../lib/table/table.module.php';
include_once '../../lib/table/table.category.php';
include_once '../module-validate.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateModule())  
{ 
			if (!isset($_GET['module_id'])) {
				moduleAdd('banner_categories', $_POST);
			} else {
				moduleEdit($_GET['module_id'], $_POST);
			}
//						
			$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa thành công module Loại Sản Phẩm Giới Thiệu !';
//
			header ("location: ".urlAdminModule());
}

		

		if (!isset($_GET['module_id'])) {
			$url_action = urlAdminModuleBannerCategories();
		} else {
			$url_action = urlAdminModuleBannerCategories().'?module_id=' . $_GET['module_id'];
		}
		
		$url_cancel = urlAdminModule(); 
		
		if (isset($_GET['module_id']) && ($_SERVER['REQUEST_METHOD'] != "POST")) {
			$module_info = moduleGetById($_GET['module_id']);
		}
//		var_dump($module_info);
		if (isset($_POST['name'])) {
			$module_name = $_POST['name'];
		} elseif (!empty($module_info)) {
			$module_name = $module_info['name'];
		} else {
			$module_name = '';
		}

		

		//$featured_books = array();
		$banner_categories = array();
		
		if (isset($_POST['category'])) {
			$categories = $_POST['category'];
		} elseif (!empty($module_info)) {
			$categories = $module_info['category'];
		} else {
			$categories = array();
		}	
		
		foreach ($categories as $category_id) 
		{
			//$book_info = bookGetById($book_id);
			$category_info = categoryGetById($category_id);

			if ($category_info) {
				$banner_categories[] = array(
					'category_id' => $category_info['category_id'],
					'name'       => $category_info['name']
				);
			}
		}
		
		if (isset($_POST['limit'])) {
			$limit = $_POST['limit'];
		} elseif (!empty($module_info)) {
			$limit = $module_info['limit'];
		} else {
			$limit = 5;
		}	
		
		// Độ rộng ảnh loại sản phẩm 					
		if (isset($_POST['width'])) {
			$width = $_POST['width'];
		} elseif (!empty($module_info)) {
			$width = $module_info['width'];
		} else {
			$width = 200;
		}	
		
		// Chiều cao ảnh loại sản phẩm 
		if (isset($_POST['height'])) {
			$height = $_POST['height'];
		} elseif (!empty($module_info)) {
			$height = $module_info['height'];
		} else {
			$height = 200;
		}		
		
		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		} elseif (!empty($module_info)) {
			$status = $module_info['status'];
		} else {
			$status = '';
		}
 
$web_title = 'Module-'.$module_name;
 
// Chỉ định nội dung riêng cho trang này 
$web_content = "../../ui/admin/view/view-module-banner-categories.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

include_once FILE_LAYOUT_ADMIN;