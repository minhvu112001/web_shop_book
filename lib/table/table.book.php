<?php
include_once 'tool.image.php';
include_once 'table.module.php';
/**
 * Các hàm quản lý sản phẩm
 */
	
/**
 * Đếm tổng số sản phẩm dựa theo một tập các tiêu chí nhất định.
 * 
 * @return a string
 * @synchronize with getBooks()
 * 
 * Ví dụ:
	 	SELECT COUNT(DISTINCT p.book_id) AS total 
	 	FROM `book` AS p 
		WHERE p.name LIKE '%%' AND p.model LIKE '%%' AND p.price LIKE '%%' ;
*/
function bookGetTotal($data=array())
{
		$filter_name = "%".db_escape($data['filter_name']) . "%";
		$filter_model = "%".db_escape($data['filter_model']) . "%";
		$filter_author_id = "%".db_escape($data['filter_author_id']) . "%";
		$filter_price = "%".db_escape($data['filter_price']) . "%";
		
		$sql = "
			SELECT COUNT(DISTINCT `book_id`) AS total
			FROM `book` AS p
			WHERE `name` LIKE '{$filter_name}'
				AND `model` LIKE '{$filter_model}'
				AND `author_id` LIKE '{$filter_author_id}'
				AND `price` LIKE '{$filter_price}'
		";
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
		}
		
		//echo $sql; die();
		
		$rs = db_one($sql);
		if ( !is_null($rs) ) 
		{
			return $rs;
		}

		return false;
} // end bookGetTotal()
	
/**
 * Lấy ra tất cả các sản phẩm dựa trên một tập các tiêu chí nhất định,
 * đồng bộ với hàm: getTotalBooks()
 * 
 * Ví dụ:
	 SELECT * FROM `book` 
	 WHERE `name` LIKE '%%' 
	 	AND `model` LIKE '%%' 
	 	AND `author_id` LIKE '%%'
	 	AND `price` LIKE '%%' 
	 ORDER BY `name` ASC 
	 LIMIT 0,20;
	 
	Chú ý: đừng dùng phép so sánh bằng AND `author_id` = '%...%'
	vì lần đầu tiên chưa có giá trị nó sẽ ko đúng.
	
 * @param array $data Mảng các tiêu chí truy vấn sản phẩm
 * @return an indexed array of associative arrays
 
*/
function bookGetAll($data = array())
{
		$filter_name = "%".db_escape($data['filter_name']) . "%";
		$filter_model = "%".db_escape($data['filter_model']) . "%";
		$filter_author_id = "%".db_escape($data['filter_author_id']) . "%";
		$filter_price = "%".db_escape($data['filter_price']) . "%";
		
		$sql = "
			SELECT *
			FROM `book` AS p
			WHERE `name` LIKE '{$filter_name}'
				AND `model` LIKE '{$filter_model}'
				AND `author_id` LIKE '{$filter_author_id}'
				AND `price` LIKE '{$filter_price}'
		";
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND `status` = '" . (int)$data['filter_status'] . "'";
		}
		
		//$sql .= " GROUP BY p.book_id";

		$sort_data = array(
			'p.book_id',
			'p.name',
			'p.model',
			'p.author_id',
			'p.publisher_id',
			'p.price',
			'p.status',
			'p.sort_order'
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY `name`";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		// Nhúng thông tin phân trang vào trong $sql
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = settings('config_limit_admin');
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
			return $rs;
		}

		return false;
		
} // end function
	
/**
 * Thêm mới sản phẩm
 * @returns Book Id
 */
function bookAdd($data)
{
	
			$model           = db_escape($data['model']);
			$publisher_id = (int)$data['publisher_id'];
			$author_id = (int)$data['author_id'];
			$price           = (float)$data['price'];
			$status          = (int)$data['status'];
			$sort_order      = (int)$data['sort_order'];
			
			$name             = db_escape($data['name']);
			$description      = db_escape($data['description']);
			$tag              = db_escape($data['tag']);
			
			$sql = " 
				INSERT INTO `book`
				SET model = '{$model}',
					publisher_id = '{$publisher_id}',
					author_id = '{$author_id}',
					price = '{$price}',
					status = '{$status}',
					sort_order = '{$sort_order}',
					date_added = NOW(),
					name = '{$name}', 
					description = '{$description}',
					tag = '{$tag}' 
			";
			//echo $sql;die();
			db_q($sql);
			
			// get newly inserted id
			$book_id = (int)db_lastID();
			
			// Ảnh đại diện / Book Image Thumbnail
			if (isset($data['image'])) {
				$img = db_escape($data['image']);
				db_q("UPDATE `book` SET `image` = '{$img}' WHERE `book_id` = '{$book_id}'");
			}
			
			// Bộ ảnh của riêng sản phẩm này / Book Image Collection
			if (isset($data['book_image'])) 
			{
				foreach ($data['book_image'] as $book_image) 
				{
					$image = db_escape($book_image['image']);
					$sort_order = (int)$book_image['sort_order'];
					
					// Nếu ảnh này đã được liên kết với sản phẩm rồi thì thôi, bỏ qua
					// và chuyển sang ảnh tiếp theo của sản phẩm.
					if(in_array($image, bookImages($book_id)))
						continue;
					
					
					db_q("
						INSERT INTO `book_image` 
						SET `book_id` = '{$book_id}', 
						    `image` = '{$image}', 
						    `sort_order` = {$sort_order}");
				}
			}
			
			// Loại sản phẩm Book Category
			if (isset($data['book_category'])) 
			{
				foreach ($data['book_category'] as $category_id) 
				{
					db_q("
						INSERT INTO `book_to_category` 
						SET `book_id` = '{$book_id}', 
						`category_id` = '{$category_id}'"
					);
				}
			}
			
			// Các sản phẩm liên quan / Book Related
			if (isset($data['book_related'])) 
			{
				foreach ($data['book_related'] as $related_id) 
				{
					db_q("DELETE FROM `book_related` WHERE `book_id` = '{$book_id}' AND `related_id` = '{$related_id}'");
					db_q("INSERT INTO `book_related` SET `book_id` = '{$book_id}', `related_id` = '{$related_id}'");
					db_q("DELETE FROM `book_related` WHERE `book_id` = '{$related_id}' AND `related_id` = '{$book_id}'");
					db_q("INSERT INTO `book_related` SET `book_id` = '{$related_id}', `related_id` = '{$book_id}'");
				}
			}
			
			return $book_id;

} // end function addBook()
	
/**
 * Sửa thông tin sản phẩm
 * @returns the id of the editted record
 */
function bookEdit($book_id, $data)
{
			// Tinh chỉnh dữ liệu trước khi cập nhật
			$model           = db_escape($data['model']);
			$publisher_id = (int)$data['publisher_id'];
			$author_id = (int)$data['author_id'];
			$price           = (float)$data['price'];
			$status          = (int)$data['status'];
			$sort_order      = (int)$data['sort_order'];
			$name             = db_escape($data['name']);
			$description      = db_escape($data['description']);
			$tag              = db_escape($data['tag']);
			
			$sql = " 
				UPDATE book
				SET model = '{$model}',
					publisher_id = '{$publisher_id}',
					author_id = '{$author_id}',
					price = '{$price}',
					status = '{$status}',
					sort_order = '{$sort_order}',
					date_modified = NOW(),
					name = '{$name}', 
					description = '{$description}',
					tag = '{$tag}' 
			WHERE book_id = '{$book_id}'";
			
			db_q($sql);
			
			// Ảnh đại diện / Book Image Thumbnail
			if (isset($data['image'])) {
				$image = db_escape($data['image']);
				
				$sql = "UPDATE `book` SET `image` = '{$image}' WHERE `book_id` = '{$book_id}'";
				db_q($sql);
			}
			
			// Bộ sưu tập ảnh sản phẩm này / Book Image Collection
			db_q("DELETE FROM `book_image` WHERE `book_id` = '{$book_id}'");

			if (isset($data['book_image'])) 
			{
				foreach ($data['book_image'] as $book_image) 
				{
					$image = db_escape($book_image['image']);
					$sort_order = (int)$book_image['sort_order']; // (int) để tránh lỗi Incorrect integer value: '' for column 'sort_order' at row 1
					
					// Nếu ảnh này đã được liên kết với sản phẩm rồi thì thôi, bỏ qua
					// và chuyển sang ảnh tiếp theo của sản phẩm.
					if(in_array($image, bookImages($book_id)))
						continue;
					
					
					db_q("
						INSERT INTO `book_image` 
						SET `book_id` = '{$book_id}',
						    `image` = '{$image}', 
						    `sort_order` = '{$sort_order}'");
				}
			}
			
			// Những loại sản phẩm liên quan / Book To Category
			db_q("DELETE FROM `book_to_category` WHERE `book_id` = '{$book_id}'");

			if (isset($data['book_category'])) {
				foreach ($data['book_category'] as $category_id) {
					db_q("INSERT INTO `book_to_category` SET `book_id` = '{$book_id}', `category_id` = '{$category_id}'");
				}
			}
			
			// Các sản phẩm khác liên quan / Book Related
			db_q("DELETE FROM `book_related` WHERE `book_id` = '{$book_id}'");
			db_q("DELETE FROM `book_related` WHERE `related_id` = '{$book_id}'");
			
			if (isset($data['book_related'])) {
				foreach ($data['book_related'] as $related_id) {
					db_q("DELETE FROM `book_related` WHERE `book_id` = '{$book_id}' AND `related_id` = '{$related_id}'");
					db_q("INSERT INTO `book_related` SET `book_id` = '{$book_id}', `related_id` = '{$related_id}'");
					db_q("DELETE FROM `book_related` WHERE `book_id` = '{$related_id}' AND `related_id` = '{$book_id}'");
					db_q("INSERT INTO `book_related` SET `book_id` = '{$related_id}', `related_id` = '{$book_id}'");
				}
			}
			
			return $book_id;
}
	
/**
 * Sao chép thông tin sản phẩm sang một bản ghi mới.
 * Tiện cho việc thêm mới một sản phẩm có nhiều thông tin trùng với một sản phẩm đã có sẵn.
 * 
 * @return an indexed array of associative arrays
 */
function bookCopy($book_id)
{
		// Lấy ra dữ liệu của bản ghi gốc
		$sql = " 
			SELECT DISTINCT * 
			FROM `book`
			WHERE `book_id` = '{$book_id}'
		";
		$rs = db_row($sql);
		
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				$data = array();

				$data = $rs;
				
				// Tinh chỉnh một vài điểm
				$data['status'] = '0';
	
				$data = array_merge($data, array('book_image' => bookGetImages($book_id)));
				$data = array_merge($data, array('book_related' => bookGetRelatedBooks($book_id)));
				$data = array_merge($data, array('book_category' => bookGetCategories($book_id)));
				
				// Tiến hành copy (thêm mới bản ghi với nội dung giống bản ghi gốc)
				bookAdd($data);
		}

			return true;
}	// end function
	
/**
 * Xóa sản phẩm dựa trên mã
 * 
 * @return book_id if successfully deleted
 * @return false if failed to delete
 */
function bookDelete($book_id)
{
	// Đếm xem có bao nhiêu đơn hàng đặt sản phẩm này
	$count = (int)db_one("SELECT COUNT(book_id) FROM `order_details` WHERE `book_id`='{$book_id}'");
	$_SESSION['ERROR_TEXT'] = null;
	
	// Nếu như có đơn hàng đặt sản phẩm này thì không thể xóa nó đi khỏi
	// bảng `book` được !!!
	if ($count > 0) 
	{
		$_SESSION['ERROR_TEXT'] = "Không thể xóa sản phẩm id={$book_id} vì tồn tại trong đơn hàng!";
		return false;
	}
	
	// Xóa dữ liệu ở các bảng liên quan
	db_q("DELETE FROM `book_image` WHERE `book_id` = '{$book_id}'");
	db_q("DELETE FROM `book_related` WHERE `book_id` = '{$book_id}'");
	db_q("DELETE FROM `book_related` WHERE `related_id` = '{$book_id}'");
	db_q("DELETE FROM `book_to_category` WHERE `book_id` = '{$book_id}'");
			
	// sau đó xóa bản ghi cần xóa.
	db_q("DELETE FROM `book` WHERE `book_id` = '{$book_id}'");
	
	return $book_id;
} // end function
	
/**
 * Lấy ra thông tin một sản phẩm dựa trên mã
 * @returns an associative array
 */
function bookGetById($book_id)
{
		$sql = " 
			SELECT DISTINCT *
			FROM `book` AS p 
			WHERE p.book_id = {$book_id}  
		";
		
		$rs = db_row($sql);
		
		if ( is_array($rs) && !empty($rs) ) 
		{
				return $rs;
		}

		return false;
} // end function
	
/**
 * Lấy ra các loại sản phẩm mà sản phẩm này thuộc về
 * @returns an indexed array of strings
 */
function bookGetCategories($book_id)
{
		$book_category_data = array();
		
		$sql = " 
			SELECT *
			FROM `book_to_category`
			WHERE book_id = {$book_id}
		";

		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) ) 
		{
				foreach ($rs as $result) {
					$book_category_data[] = $result['category_id'];
				}
		
				return $book_category_data;
		}

		return false;
} // end function
	
	
/**
 * Lấy ra các ảnh của một sản phẩm
 * @returns an indexed array of associative arrays
 */
function bookGetImages($book_id)
{
		$sql = " 
			SELECT *
			FROM `book_image`
			WHERE book_id = {$book_id}
			ORDER BY sort_order ASC
		";
		
		$rs = db_q($sql);
		if ( is_array($rs) && !empty($rs) )
		{
			return $rs;
		}

		return false;
} // end function
	
/*
 Lấy ra Id của các sản phẩm khác liên quan đến sản phẩm này.
 Chỉ lấy ra dữ liệu thô nguyên vẹn từ cơ sở dữ liệu mà ko định dạng. 
 
 @returns an indexed array of associative arrays
 */
function bookGetRelatedBooks($book_id)
{
	    $book_related_data = array();
	    
		$sql = " 
			SELECT *
			FROM `book_related`
			WHERE `book_id` = {$book_id}
		";
		$rs = db_q($sql);
		
		if ( is_array($rs) && !empty($rs) )
		{
				foreach ($rs as $result) {
					$book_related_data[] = $result['related_id'];
				}
		
				return $book_related_data;
		}

		return false;
} // end function

/**
 * Lấy ra thông tin chi tiết của một sản phẩm (có tính cả các thông tin nằm trong các bảng khác)
 * 
 * @param $book_id mã sản phẩm
 * @return an associative array
 */

function bookDetails($book_id)
{
		$sql = " 
			SELECT DISTINCT *, 
				p.name AS name, 
				p.image, 
				m.name AS publisher, 
				p.sort_order 
		    FROM book p
		    LEFT JOIN publisher m ON (p.publisher_id = m.publisher_id) 
			WHERE p.book_id = '$book_id' AND p.status = '1'
		";
		$rs = db_row($sql);

		if ( is_array($rs) && !empty($rs) ) 
		{
			return array(
				'book_id'       => $rs['book_id'],
				'name'             => $rs['name'],
				'description'      => $rs['description'],
				'tag'              => $rs['tag'],
				'model'            => $rs['model'],
				'image'            => $rs['image'],
				'publisher_id'  => $rs['publisher_id'],
				'publisher'     => $rs['publisher'],
				'price'            => $rs['price'],
				'sort_order'       => $rs['sort_order'],
				'status'           => $rs['status'],
				'date_added'       => $rs['date_added'],
				'date_modified'    => $rs['date_modified']
			);
		} 
		else 
		{
			return false;
		}
}// end function


/**
 * Lấy ra các sản phẩm liên quan đến sản phẩm này
 * 
 * @param $book_id mã sản phẩm
 */
function booksRelated($book_id)
{
	// Khởi tạo danh sách các sản phẩm liên quan
	$relateds = array();
		
	// Lấy ra dữ liệu thô trong db của các sản phẩm liên quan
	$sql = " 
		SELECT * 
		FROM book_related pr 
		LEFT JOIN book p ON (pr.related_id = p.book_id) 
		WHERE pr.book_id = '{$book_id}'
			AND p.status = '1' 
	";
	$rs = db_q($sql);
		
	if ( is_array($rs) && !empty($rs) )
	{
		foreach ($rs as $result) 
		{
			
			if ($result['image'])
			{
				$related_image = img_resize($result['image'], settings('config_image_related_width'), settings('config_image_related_height'));
			}
			else
			{
				$related_image = img_resize('placeholder.png', settings('config_image_related_width'), settings('config_image_related_height'));
			}
			
			$relateds[] = array(
					'book_id'  => $result['book_id'],
					'thumb'       => $related_image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_book_description_length')) . '..',
					'price'       => number_format($result['price'],0,'.',',').' ₫',
					'href'        => urlBookDetails().'?book_id=' . $result['book_id']
			);
			
		}

	}

	return $relateds;
} // end getBookRelated($book_id)



/**
 * Đếm tổng số sản phẩm dựa theo tiêu chí tìm kiếm.
 * 
 * @todo Đồng nhất hàm này với hàm bookGetAllForSearch()
 */
function bookGetTotalForSearch($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.book_id) AS total
		FROM `book` p
		WHERE p.status = '1'
	";
			
			
	if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
		$sql .= " AND (";
	
		if (!empty($data['filter_name'])) {
					$implode = array();
					
					// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
					
					// so sánh mỗi từ đó với tên sản phẩm
					foreach ($words as $word) {
						$implode[] = "p.name LIKE '%" . db_escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
					
					// Nếu như tìm kiếm cả trong phần mô tả sản phẩm
					if (!empty($data['filter_description'])) {
						$sql .= " OR p.description LIKE '%" . db_escape($data['filter_name']) . "%'";
					}
		}
	
		if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) {
					$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.model) = '" . db_escape(utf8_strtolower($data['filter_name'])) . "'";
		}
	
		$sql .= ")";
	}
			
	$rs = db_one($sql);
	
	return $rs;
}	

/**
 * Lấy ra tất cả các sản phẩm phù hợp với tiêu chí tìm kiếm.
 * Tìm theo tên, mô tả, tag (từ khóa)
 * 
 * Đồng nhất hàm này với hàm bookGetTotalForSearch()
 */
function bookGetAllForSearch($data = array())
{
	$sql = " 
		SELECT *
		FROM `book` p
		WHERE p.status = '1' 
	";
			
			
	if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
		$sql .= " AND (";
	
		if (!empty($data['filter_name'])) {
					$implode = array();
					
					// Bẻ nhỏ các từ khóa trong chuỗi kí tự tìm kiếm
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
					
					// so sánh mỗi từ đó với tên sản phẩm
					foreach ($words as $word) {
						$implode[] = "p.name LIKE '%" . db_escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
					
					// Nếu như tìm kiếm cả trong phần mô tả sản phẩm
					if (!empty($data['filter_description'])) {
						$sql .= " OR p.description LIKE '%" . db_escape($data['filter_name']) . "%'";
					}
		}
	
		if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
		}
	
		if (!empty($data['filter_tag'])) {
					$sql .= "p.tag LIKE '%" . db_escape(utf8_strtolower($data['filter_tag'])) . "%'";
		}
	
		if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.model) = '" . db_escape(utf8_strtolower($data['filter_name'])) . "'";
		}
	
		$sql .= ")";
	}
	
	// Trật tự sắp xếp
	$sort_data = array(
			'p.name',
			'p.model',
			'p.price',
			'p.sort_order',
			'p.date_added'
	);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.name) DESC";
		} else {
			$sql .= " ASC, LCASE(p.name) ASC";
		}
	
	// Phân trang
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 * Đếm tất cả các sản phẩm thuộc về cùng một nhà sản xuất.
 * @param array $data
 */
function bookGetTotalForPublisher($data = array())
{
	$sql = " 
		SELECT COUNT(DISTINCT p.book_id) AS total
		FROM `book` p
		WHERE p.status = '1' 
		
	";
			
	if (!empty($data['filter_publisher_id'])) 
	{
		$sql .= " AND p.publisher_id = '" . (int)$data['filter_publisher_id'] . "'";
	}
	
	$rs = db_one($sql);
	
	return $rs;
}

/**
 * Lấy ra tất cả các sản phẩm thuộc về cùng một nhà sản xuất.
 * @param array $data
 * @return array();
 */
function bookGetAllForPublisher($data = array())
{
	$sql = " 
		SELECT *
		FROM `book` p
		WHERE p.status = '1' 
	";
	
	if (!empty($data['filter_publisher_id'])) 
	{
		$sql .= " AND p.publisher_id = '" . (int)$data['filter_publisher_id'] . "'";
	}
			
	// Trật tự sắp xếp
	$sort_data = array(
			'p.name',
			'p.model',
			'p.price',
			'p.sort_order',
			'p.date_added'
	);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.name) DESC";
	} else {
			$sql .= " ASC, LCASE(p.name) ASC";
	}
	
	// Phân trang
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
	$rs = db_q($sql);
	
	return $rs;
}	

/**
 @description Tính tổng số sản phẩm thuộc về loại sản phẩm này
 
 @param $category_id int Id loại sản phẩm
 @return int tổng số sản phẩm
 */
function bookGetTotalForCategory($category_id)
{
	$sql = " 
		SELECT COUNT(DISTINCT p.book_id) AS total
		FROM `book_to_category` AS p2c
		LEFT JOIN `book` AS p ON (p2c.book_id = p.book_id)
		WHERE p.status = '1' 
				AND p2c.category_id = '{$category_id}'
    ";
			
	return (int)db_one($sql);
	
}

/**
 @description Lấy ra toàn bộ các bản ghi sản phẩm (có phân trang) của loại sản phẩm truyền vào
 @return array Mảng chỉ số, mỗi phần tử là mảng kết hợp biểu diễn một bản ghi sản phẩm
 $filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
 */
function bookGetAllForCategory($data = array()) 
{
	$category_id = (int)$data['filter_category_id'];
	$sql = " 
		SELECT *
		FROM `book_to_category` AS p2c
		LEFT JOIN `book` AS p ON (p2c.book_id = p.book_id)
		WHERE p.status = '1' 
			AND p2c.category_id = '{$category_id}'
		GROUP BY p.book_id
	";

	$sort_data = array(
		'p.name',
		'p.model',
		'p.price',
		'p.sort_order',
		'p.date_added'
	);
	
	// Sắp xếp theo cột nào ?
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
	{
			if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
	} else {
			$sql .= " ORDER BY p.sort_order";
	}

	// Sắp xếp tăng hay giảm ?
	if (isset($data['order']) && ($data['order'] == 'DESC')) 
	{
			$sql .= " DESC, LCASE(p.name) DESC";
	} else {
			$sql .= " ASC, LCASE(p.name) ASC";
	}
	
	// Phân trang
	if (isset($data['start']) || isset($data['limit'])) 
	{
		if ($data['start'] < 0) 
		{
			$data['start'] = 0;
		}

		if ($data['limit'] < 1) 
		{
			$data['limit'] = 20;
		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}
	
	return db_q($sql);
}

/*
 @return Mảng chỉ số. Mỗi phần tử lại là một mảng kết hợp (key => value) biểu diễn
 		các thuộc tính của sản phẩm.
 
 @description Lấy ra danh sách các sản phẩm nổi bật. Danh sách này được ấn định một cách
 			tùy ý từ màn hình quản trị.
 */
function booksFeatured()
{
	// Lấy ra danh sách id các sản phẩm nổi bật
	// và giới hạn số lượng hiển thị trên module.
	// Các thông tin này được lưu trong module: featured
	$setting = moduleGetByCode("featured");
	

	$books = array_slice($setting['book'], 0, (int)$setting['limit']);


	$featuredBooks = array();

	foreach ($books as $book_id) 
	{
		$book_info = bookDetails($book_id);
		
				
				if ($book_info) {
					if (is_file(DIR_IMAGE . $book_info['image'])) {
						$image = img_resize($book_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = img_resize('placeholder.png', $setting['width'], $setting['height']);
					}
	
					$price = number_format($book_info['price'],0,'.',',').' ₫';
	
	
					if (settings('config_review_status')) {
						$rating = $book_info['rating'];
					} else {
						$rating = false;
					}
	
					$featuredBooks[] = array(
						'book_id'  => $book_info['book_id'],
						'thumb'       => $image,
						'name'        => $book_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($book_info['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_book_description_length')) . '..',
						'price'       => $price,
						'rating'      => $rating,
						'href'        => urlBookDetails().'?book_id=' . $book_info['book_id'],
						'href_man'    => urlPublisherInfo().'?publisher_id=' . $book_info['publisher_id'],
						'publisher_href'    => urlPublisherInfo().'?publisher_id=' . $book_info['publisher_id'],
						'publisher' => $book_info['publisher'],
						'publisher_id' => $book_info['publisher_id'],
						'model' => $book_info['model'],
						'availability' => ((int)$book_info['status'] == 1) ? 'Còn hàng' : 'Hết hàng',
					);
				}
	}
	
	return $featuredBooks;
}// end function

// Lấy ra danh sách id các sản phẩm thuộc một module như: 
// featured, best_seller, specials, latest, banner_books
// và giới hạn số lượng hiển thị trên module.

function bookGetByModule($module)
{
	
	$setting = moduleGetByCode($module);

	$books = array_slice($setting['book'], 0, (int)$setting['limit']);


	$booksForModule = array();

	foreach ($books as $book_id) 
	{
		$book_info = bookDetails($book_id);
	
				if ($book_info) {
					//if ($book_info['image']) {
					if (is_file(DIR_IMAGE . $book_info['image'])) {
						$image = img_resize($book_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = img_resize('placeholder.png', $setting['width'], $setting['height']);
					}
	
					$price = number_format($book_info['price'],0,'.',',').' ₫';
	
	
					if (settings('config_review_status')) {
						$rating = $book_info['rating'];
					} else {
						$rating = false;
					}
	
					$booksForModule[] = array(
						'book_id'  => $book_info['book_id'],
						'thumb'       => $image,
						'name'        => $book_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($book_info['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_book_description_length')) . '..',
						'price'       => $price,
						'rating'      => $rating,
						'href'        => urlBookDetails().'?book_id=' . $book_info['book_id'],
						'publisher' => $book_info['publisher'],
						'publisher_id' => $book_info['publisher_id'],
						'model' => $book_info['model'],
						'availability' => ((int)$book_info['status'] == 1) ? 'Còn hàng' : 'Hết hàng',
					);
				} //else echo 'failed: '.$book_id;
	}
	
	return $booksForModule;
}// end function

/*
 Lấy ra danh sách các đường dẫn ảnh của một sản phẩm
 @return indexed array
 */
function bookImages($book_id)
{
	// Nhặt ra các bản ghi trong bảng
	$temp = db_q("SELECT `image` FROM `book_image` WHERE `book_id`='{$book_id}'");
	
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