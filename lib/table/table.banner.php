<?php
include_once '../tool.image.php';
include_once 'table.module.php';

/**
 * Quản lý banner
 */
	
function bannerAdd($data) 
{
		// Tinh chỉnh dữ liệu thô
		$name = db_escape($data['name']);
		$status = (int)$data['status'];
		
		// Tạo mới banner trong cơ sở dữ liệu
		$sql = " 
			INSERT INTO `banner` 
			SET `name` = '{$name}',
				`status` = '{$status}'
		";
		db_q($sql);

		$banner_id = db_lastID();
		
		// Thêm mới các ảnh của banner vừa tạo
		if (isset($data['banner_image'])) 
		{
			foreach ($data['banner_image'] as $banner_image) 
			{
				
				$link        = db_escape($banner_image['link']);
				$image       = db_escape($banner_image['image']);
				$sort_order  = (int)$banner_image['sort_order'];
				$bid         = (int)$banner_id;
				$title       = db_escape($banner_image['title']);
				$sub_title   = db_escape($banner_image['sub_title']);
				$description = db_escape($banner_image['description']);
				$price       = (float)$banner_image['price'];
				
				// Nếu ảnh này đã được liên kết với banner rồi thì thôi, bỏ qua
				// và chuyển sang ảnh tiếp theo của banner.
				if(in_array($image, bannerImages($banner_id)))
					continue;
				
				$sql2 = " 
					INSERT INTO `banner_image` 
					SET `banner_id` = '{$bid}', 
						`link` = '{$link}', 
						`image` = '{$image}',
						`sort_order` = '{$sort_order}',
						`title` = '{$title}',
						`sub_title` = '{$sub_title}',
						`description` = '{$description}',
						`price` = '{$price}'
				";
				db_q($sql2);
			
			}
		}

		return $banner_id;
}
	
function bannerEdit($banner_id, $data) 
{

		$name = db_escape($data['name']);
		$status = (int)$data['status'];
		$bid = (int)$banner_id;
		
		db_query("UPDATE banner SET name = '{$name}', status = '{$status}' WHERE banner_id = '{$bid}'");

		db_query("DELETE FROM banner_image WHERE banner_id = '{$bid}'");
		
		// Các ảnh của banner này
		if (isset($data['banner_image'])) 
		{
			foreach ($data['banner_image'] as $banner_image) 
			{
				
				$link        = db_escape($banner_image['link']);
				$image       = db_escape($banner_image['image']);
				$sort_order  = (int)$banner_image['sort_order'];
				$title       = db_escape($banner_image['title']);
				$sub_title   = db_escape($banner_image['sub_title']);
				$description = db_escape($banner_image['description']);
				$price       = (float)$banner_image['price'];
				
				// Nếu ảnh này đã được liên kết với banner rồi thì thôi, bỏ qua
				// và chuyển sang ảnh tiếp theo của banner.
				if(in_array($image, bannerImages($banner_id)))
					continue;
				
				$sql = " 
					INSERT INTO `banner_image` 
					SET `banner_id` = '{$bid}', 
						`link` = '{$link}', 
						`image` = '{$image}',
						`sort_order` = '{$sort_order}',
						`title` = '{$title}',
						`sub_title` = '{$sub_title}',
						`description` = '{$description}',
						`price` = '{$price}'
				";
				db_q($sql);
				
			}
		}
}
	
function bannerDelete($banner_id) 
{
		// Xóa dữ liệu ở các bảng liên quan...
		db_q("DELETE FROM banner_image WHERE banner_id = '" . (int)$banner_id . "'");
		
		// ...sau đó xóa bản ghi cần xóa
		db_q("DELETE FROM banner WHERE banner_id = '" . (int)$banner_id . "'");
		
}
	
function bannerGetTotal() 
{
	return db_one("SELECT COUNT(*) AS total FROM banner");
}
	
function bannerGetAll($data = array()) 
{
		$sql = "SELECT * FROM banner";

		$sort_data = array(
			'name',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		return db_query($sql);
}
	
function bannerGetById($banner_id) 
{
		return db_row("SELECT DISTINCT * FROM banner WHERE banner_id = '" . (int)$banner_id . "'");
}
	
function bannerGetImages($banner_id) 
{
	return db_query("SELECT * FROM banner_image WHERE banner_id = '" . (int)$banner_id . "' ORDER BY sort_order ASC");
}

function bannerGetDetailsById($banner_id)
{
	$bid = (int)$banner_id;
	$sql = " 
		SELECT * FROM `banner_image` 
		WHERE `banner_id` = '{$bid}' 
		ORDER BY `sort_order` ASC
	";
	$rs = false;

	$rs = db_q($sql);
			
	if ( is_array($rs) && !empty($rs) ) 
	{
		return $rs;
	}
	
	return false;
}

function bannerGetDetailsByModule($module_code)
{
	$setting = moduleGetByCode($module_code);

	// Lấy ra các ảnh của banner từ bảng banner_image
	$results = bannerGetDetailsById($setting['banner_id']);		

	$banners = array();
	foreach ($results as $result) 
	{
	
		if (is_file(DIR_IMAGE . $result['image'])) 
		{
			$banners[] = array(
				'title' => $result['title'],
				'sub_title' => $result['sub_title'],
				'description' => $result['description'],
				'price'  => $result['price'],
				'link'  => $result['link'],
				'image' => img_resize($result['image'], $setting['width'], $setting['height'])
			);
		}
	}
	
	return $banners;
}// end function

// Lấy ra các banner hiển thị trên slideshow trang chủ
function homeSlideshowBanners()
{
	return bannerGetDetailsByModule('slideshow'); 
}

// Lấy ra các banner hiển thị trên carousel trang chủ
function homeCarouselBanners()
{
	return bannerGetDetailsByModule('carousel');
}


/*
 Lấy ra danh sách các đường dẫn ảnh của một banner
 @return indexed array
 */
function bannerImages($banner_id)
{
	// Nhặt ra các bản ghi trong bảng
	$temp = db_q("SELECT `image` FROM `banner_image` WHERE `banner_id`='{$banner_id}'");

	// sau đó copy các đường dẫn ảnh vào trong một mảng:
	$images = array();

	if(is_array($temp) && !empty($temp))
	{
		foreach($temp as $img)
		{
			$images[] = $img['image'];
		}
	}

	return $images;


}// end function