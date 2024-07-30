<?php
include_once '../configs.php';
include_once '../lib/table/table.order.php';

checkLogin();

// Nội dung riêng của trang...
$web_title = "Quản Trị";
$web_content = DIR_UI."admin/view/view-dashboard.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_DASHBOARD;

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// do something with the file
include_once FILE_LAYOUT_ADMIN;