<?php
/**
 * Các hàm quản lý Tác Giả
 */
function authorAdd($data) 
{

		// Tên nhà sản xuất 
		$name = db_escape($data['name']);
		$sort_order = (int)$data['sort_order'];
		$description = db_escape($data['description']);
		
		// Sử dụng cú pháp INSERT INTO ... SET
		// để không phải viết các tên cột trên một hàng dài.
		$sql = "
			INSERT INTO `author`
			SET `name` = '{$name}',
			    `sort_order` = '{$sort_order}',
			    `description` = '{$description}'
			";
		db_q($sql);
		
		$author_id = (int)db_lastID();
	
		// Ảnh tác giả
		if (isset($data['image'])) 
		{
			$image = db_escape($data['image']);
			db_q("UPDATE `author` SET `image` = '{$image}' WHERE `author_id` = '{$author_id}'");
		}

		return $author_id;
}
	
function authorEdit($author_id, $data) 
{ 
		$name = db_escape($data['name']);
		$sort_order = (int)$data['sort_order'];
		$description = db_escape($data['description']);
		$aid = (int)$author_id;
		
		
		// Sử dụng cú pháp INSERT INTO ... SET
		// để không phải viết các tên cột trên một hàng dài.
		$sql = "
			UPDATE `author`
			SET `name` = '{$name}',
				`sort_order` = '{$sort_order}',
				`description` = '{$description}'
			WHERE `author_id` = '{$aid}'
		";
		
		db_q($sql);
		
		// Ảnh tác giả
		if (isset($data['image'])) 
		{
			$image = db_escape($data['image']);
			db_q("UPDATE `author` SET `image` = '{$image}' WHERE `author_id` = '{$aid}'");
			
		}

}
	
function authorDelete($author_id) 
{
	// @todo xóa đi các bản ghi liên quan đến nhà sản xuất này trước.
	// quan hệ giữa sách và tác giả là quan hệ: một-nhiều
	// Nếu phát hiện là có nhiều sách do tác giả này viết thì ngăn không cho xóa.
	
	db_q("DELETE FROM `author` WHERE `author_id` = '" . (int)$author_id . "'");
}
	
function authorGetById($author_id)
{
	$sql = " 
		SELECT DISTINCT * 
		FROM `author` 
		WHERE author_id = {$author_id}
	";
	
	$rs = db_row($sql);
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}

	return false;
} // end func

function authorName($author_id)
{
	$sql = "SELECT `name` FROM `author` WHERE author_id = {$author_id}";
	
	return db_one($sql);
}

/**
 * Đếm tổng số bản ghi
 */
function authorGetTotal()
{
		$sql = "SELECT COUNT(*) AS total FROM author";
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
	 * @synchronize with authorGetTotal($data)
	 */
function authorGetAll($data = array())
{
		
		$filter_name = "%".db_escape($data['filter_name']) . "%";
		
		$sql = "
			SELECT *
			FROM `author`
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
} // end func