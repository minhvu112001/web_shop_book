<?php

include_once '../../configs.php';
include_once '../../lib/table/table.module.php';
include_once '../module-validate.php';


		if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateModule())  
		{ 
			if (!isset($_GET['module_id'])) {
				moduleAdd('best_seller', $_POST);
			} else {
				moduleEdit($_GET['module_id'], $_POST);
			}
//						
			$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa thành công module Sản Phẩm Bán Chạy Nhất';
//
			header ("location: ".urlAdminModule());
		}

		

		if (!isset($_GET['module_id'])) {
			$url_action = urlAdminModuleBestSeller();
		} else {
			$url_action = urlAdminModuleBestSeller() . '?module_id=' . $_GET['module_id'];
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

		include_once '../../lib/table/table.book.php';

		$bestseller_books = array();
		
		if (isset($_POST['book'])) {
			$books = $_POST['book'];
		} elseif (!empty($module_info)) {
			$books = $module_info['book'];
		} else {
			$books = array();
		}	
		
		foreach ($books as $book_id) 
		{
			$book_info = bookGetById($book_id);

			if ($book_info) {
				$bestseller_books[] = array(
					'book_id' => $book_info['book_id'],
					'name'       => $book_info['name']
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
		
		// Độ rộng ảnh sản phẩm					
		if (isset($_POST['width'])) {
			$width = $_POST['width'];
		} elseif (!empty($module_info)) {
			$width = $module_info['width'];
		} else {
			$width = 200;
		}	
		
		// Chiều cao ảnh sản phẩm
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
$web_content = DIR_UI."admin/view/view-module-best_seller.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

include_once FILE_LAYOUT_ADMIN;