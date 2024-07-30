<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.module.php';

$all_extensions = array();

// Mảng các đường dẫn đến các file xử lý module giao diện 
// nằm trong thư mục web/admin/module
$files = glob(DIR_APP . 'admin/module/*.php');
		
if ($files) 
{
	foreach ($files as $file) 
	{
		$extension = basename($file, '.php');

		$module_data = array();
				
		$modules = moduleGetAllByCode($extension);
				
		foreach ($modules as $module) 
		{
			$module_data[] = array(
				'module_id' => $module['module_id'],
				'name'      => strtoupper($extension) . ' &gt; ' . $module['name'],
				'edit'      => "/".APP."/admin/module/" . $extension.'.php?'.'module_id=' . $module['module_id']
			);
		}

		$all_extensions[] = array(
			'name'      => strtoupper($extension),
			'module'    => $module_data,
			'edit'      => "/".APP."/admin/module/" . $extension. '.php'
		);
	}
}
		
// Nội dung riêng của trang:
$web_content = "../ui/admin/view/view-module.php";
$web_title = 'Quản lý Modules';
$active_page_admin = ACTIVE_PAGE_ADMIN_MODULE;

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once FILE_LAYOUT_ADMIN;
