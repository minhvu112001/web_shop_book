<?php
// Cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.publisher.php';

$json = array();

$filter_name = isset($_REQUEST['filter_name']) ? $_REQUEST['filter_name'] : '';

$filter_data = array(
	'filter_name' => $filter_name,
	'start'       => 0,
	'limit'       => 10
);

$results = publisherGetAll($filter_data);

foreach ($results as $result) 
{
	$json[] = array(
		'publisher_id' => $result['publisher_id'],
		'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
	);
}
$sort_order = array();

foreach ($json as $key => $value) 
{
	$sort_order[$key] = $value['name'];
}

array_multisort($sort_order, SORT_ASC, $json);

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
