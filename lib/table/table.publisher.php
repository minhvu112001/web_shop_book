<?php
/**
 * Các hàm quản lý nhà sản xuất
 */
function publisherAdd($data) 
{

		// Tên nhà sản xuất 
		$name = db_escape($data['name']);
		$sort_order = (int)$data['sort_order'];
		db_q("INSERT INTO `publisher` SET `name` = '{$name}', `sort_order` = '{$sort_order}'");

		$publisher_id = (int)db_lastID();
	
		// Ảnh đại diện nhà sản xuất
		if (isset($data['image'])) {
			$image = db_escape($data['image']);
			db_q("UPDATE `publisher` SET `image` = '{$image}' WHERE `publisher_id` = '{$publisher_id}'");
		}

		return $publisher_id;
}
	
function publisherEdit($publisher_id, $data) 
{ 
		$name = db_escape($data['name']);
		$sort_order = (int)$data['sort_order'];
		$mid = (int)$publisher_id;
		
		db_q("UPDATE `publisher` SET `name` = '{$name}', `sort_order` = '{$sort_order}' WHERE `publisher_id` = '{$mid}'");

		if (isset($data['image'])) {
			$image = db_escape($data['image']);
			db_q("UPDATE `publisher` SET `image` = '{$image}' WHERE `publisher_id` = '{$mid}'");
			
		}

}
	
function publisherDelete($publisher_id) 
{
	// @todo xóa đi các bản ghi liên quan đến nhà sản xuất này trước.
	
	db_q("DELETE FROM `publisher` WHERE `publisher_id` = '" . (int)$publisher_id . "'");
}
	
function publisherGetById($publisher_id)
{
	$sql = " 
		SELECT DISTINCT * 
		FROM publisher 
		WHERE publisher_id = {$publisher_id}
	";
	
	$rs = db_row($sql);
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return false;
} // end getPublisher($publisher_id)

function publisherName($publisher_id)
{
	$sql = "SELECT `name` FROM `publisher` WHERE `publisher_id` = {$publisher_id}";

	return db_one($sql);
} // end getPublisher($publisher_id)

/**
 * Đếm tổng số bản ghi
 */
function publisherGetTotal()
{
		$sql = "SELECT COUNT(*) AS total FROM publisher";
		$rs = db_one($sql);
		
		if ( !is_null($rs) ) 
		{
				return $rs;
		}

		return false;
}
/**
 * Lấy ra các bản ghi để phân trang
 * 
	 * @returns an indexed array of associative arrays
	 * @returns false if failed to query
	 * @notice sort_data must work closely with html view form, url parameters
	 * 
	 * @synchronize with publisherGetTotal($data)
	 */
function publisherGetAll($data = array())
{
		
		$filter_name = "%".db_escape($data['filter_name']) . "%";
		
		$sql = "
			SELECT *
			FROM `publisher`
			WHERE name LIKE '{$filter_name}'
		";
		
       // @notice sort_data must work closely with html view form, url parameters
		$sort_data = array(
			'name',
			'sort_order'	// @check it out
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
		{
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) 
		{
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		$start = 0;
		$limit = settings('config_limit_admin');
		
		if (isset($data['start']) && (int)$data['start'] > 0)
			$start = (int)$data['start'];
			
		if (isset($data['limit']) && (int)$data['limit'] >= 1)
			$limit = (int)$data['limit'];
			
		$sql .= " LIMIT {$start},{$limit}";
		
		$rs = db_q($sql);
			
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // end getPublishers