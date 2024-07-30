<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.book.php';
include_once 'lib/tool.image.php';

// @todo những trang kiểu như này thì nên vẫn triển khai controller
// nếu viết tắt quá trong view bằng các hàm php thì e khi triển khai sang các
// theme mới sẽ không dễ.

if (isset($_GET['book_id'])) 
{
	$book_id = (int)$_GET['book_id'];
} 
else 
{
	$book_id = 0;
}

// @todo should we use a function specifically designed for homepage public
// Nếu viết theo kiểu mảng $book['key'] thì được cái là nó đồng nhất về cách viết giữa các trang
// nhưng nếu viết theo kiểu $book_key thì nó thể hiện đây chỉ là một bản ghi cho phần
// book_detail. Hơn nữa phần này cũng có trình bày sản phẩm liên quan, nó cũng dùng
// cú pháp $book['key']. Mình nên phân biệt để đỡ nhầm lẫn.
$book_info = bookDetails($book_id);

if ($book_info) 
{
	
	$book_name = $book_info['name'];
	$book_id = (int)$_GET['book_id'];
	$book_model = $book_info['model']; 
	$book_href = urlBookDetails()."?book_id=".$book_id;
	$book_link = $book_href;
	$book_publisher = $book_info['publisher'];
	
	$book_publisher_href = urlPublisherInfo().'?publisher_id=' . $book_info['publisher_id'];
	
	if (is_file(DIR_IMAGE . $book_info['image'])) 
	{
		$popup = img_resize($book_info['image'], settings('config_image_popup_width'), settings('config_image_popup_height'));
	} 
	else 
	{
		$popup = img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height'));
	}
	
	$book_popup = $popup;
	
	if (is_file(DIR_IMAGE . $book_info['image']))
	{
		$thumb = img_resize($book_info['image'], settings('config_image_thumb_width'), settings('config_image_thumb_height'));
	} 
	else 
	{
		$thumb = img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height'));
	}
	
	$book_thumb = $thumb;
			
	$book_images = array();

	$results = bookGetImages($_GET['book_id']);

	foreach ($results as $result) 
	{
		if (is_file(DIR_IMAGE . $result['image']))
		{
			$book_images[] = array(
					'popup' => img_resize($result['image'], settings('config_image_popup_width'), settings('config_image_popup_height')),
					'thumb' => img_resize($result['image'], settings('config_image_additional_width'), settings('config_image_additional_height'))
			);
		} 
		else 
		{
			$book_images[] = array(
					'popup' => img_resize('placeholder.png', settings('config_image_popup_width'), settings('config_image_popup_height')),
					'thumb' => img_resize('placeholder.png', settings('config_image_additional_width'), settings('config_image_additional_height'))
			);
		}
		
		
	}
	
	// Cờ đánh dấu xem sản phẩm này có nhiều ảnh chi tiết hay không ?
	$bookHasImages = (count($book_images) > 0) ? true : false;
			
	$book_price = number_format($book_info['price'],0,'.',',').' ₫';
			
	$description = html_entity_decode($book_info['description'], ENT_QUOTES, 'UTF-8');
	$book_description = $description;
}

// Nội dung riêng của trang...
$web_title = "Chi tiết sản phẩm";
$web_content = DIR_UI_HOME_THEMES."view/view-book-details.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

include_once FILE_LAYOUT_HOME;
	
