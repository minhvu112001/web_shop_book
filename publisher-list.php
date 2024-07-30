<?php
// cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.publisher.php';
include_once 'lib/table/table.book.php';
include_once 'lib/tool.image.php';

$publishers = array();

$results = publisherGetAll();

foreach ($results as $result) 
{
	if (is_numeric(utf8_substr($result['name'], 0, 1))) 
	{
		$key = '0 - 9';
	} 
	else 
	{
		$key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
	}

	if (!isset($publishers[$key])) 
	{
		$publishers[$key]['name'] = $key;
	}

	$publishers[$key]['publisher'][] = array(
		'name' => $result['name'],
		'href' => urlPublisherInfo().'?publisher_id=' . $result['publisher_id']
	);
}

// Nội dung riêng của trang...
$web_title = "Thương Hiệu";
$web_content = DIR_UI_HOME_THEMES."view/view-publisher-list.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site.
include_once(FILE_LAYOUT_HOME);
	