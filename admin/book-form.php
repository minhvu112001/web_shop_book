<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.book.php';
include_once '../lib/table/table.category.php';
include_once '../lib/table/table.publisher.php';
include_once '../lib/table/table.author.php';

include_once '../lib/tool.image.php';

$url = '';

if (isset($_REQUEST['filter_name'])) 
{
     $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_model'])) 
{
     $url .= '&filter_model=' . urlencode(html_entity_decode($_REQUEST['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['filter_price'])) 
{
     $url .= '&filter_price=' . $_REQUEST['filter_price'];
}

if (isset($_REQUEST['filter_status'])) 
{
     $url .= '&filter_status=' . $_REQUEST['filter_status'];
}

if (isset($_REQUEST['sort'])) 
{
     $url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order'])) 
{
     $url .= '&order=' . $_REQUEST['order'];
}

if (isset($_REQUEST['page'])) 
{
     $url .= '&page=' . $_REQUEST['page'];
}

// form action:
if (!isset($_GET['book_id'])) 
{
	// Thêm mới
	$url_action = urlAdminBookAdd();
} 
else 
{
	// Sửa
	$url_action = urlAdminBookEdit()."?book_id=".$_GET['book_id'].$url;
}

// Nếu đang là sửa thông tin trên form:
// truy vấn thông tin bản ghi từ id và gửi sang giao diện
if (isset($_GET['book_id']) && $_SERVER['REQUEST_METHOD'] != "POST") 
{
	$book_info = bookGetById($_REQUEST['book_id']);
}

// Tên sản phẩm
if (isset($_POST['book_name'])) // form submitted (add/edit)
{
	$book_name = $_POST['book_name'];
} 
elseif (isset($_GET['book_id'])) 
{	// Sửa
	$book_name = $book_info['name'];
} 
else 
{	// Thêm mới
	$book_name = '';	
}

// Mô tả sản phẩm (Book Description)
if (isset($_POST['book_description'])) // form submitted (add/edit)
{
	$book_description = $_POST['book_description'];
} 
elseif (isset($_GET['book_id'])) 
{	// Sửa
	$book_description = $book_info['description'];
} 
else 
{	// Thêm mới
	$book_description = '';	
}

// Tags
if (isset($_POST['book_tag'])) // form submitted (add/edit)
{
	$book_tag = $_POST['book_tag'];
} 
elseif (isset($_GET['book_id'])) 
{	// Sá»­a
	$book_tag = $book_info['tag'];
} 
else 
{	// Thêm mới
	$book_tag = '...';	
}
// ảnh chi tiết sản phẩm
if (isset($_POST['image'])) 
{
     $book_image = $_POST['image'];
} 
elseif (!empty($book_info)) 
{	// Sửa
     $book_image = $book_info['image'];
} 
else 
{	// Thêm mới
     $book_image = '';	
}

// Book Thumb Image
if (isset($_POST['image']) && is_file(DIR_IMAGE . $_POST['image'])) 
{
     $book_thumb = img_resize($_POST['image'], 100, 100);
} 
elseif (!empty($book_info) && is_file(DIR_IMAGE . $book_info['image'])) 
{
     $book_thumb = img_resize($book_info['image'], 100, 100);
} 
else 
{
     $book_thumb = img_resize('no_image.png', 100, 100);
}
$book_image_placeholder = img_resize('no_image.png', 100, 100); 

if (isset($_POST['model'])) 
{
     $book_model = $_POST['model'];
} 
elseif (!empty($book_info)) 
{
     $book_model = $book_info['model'];
} 
else 
{
     $book_model = '';
}

if (isset($_POST['price'])) 
{
     $book_price = $_POST['price'];
} 
elseif (!empty($book_info)) 
{
     $book_price = $book_info['price'];
} 
else 
{
     $book_price = '';
}

if (isset($_POST['sort_order'])) 
{
     $book_sort_order = $_POST['sort_order'];
} 
elseif (!empty($book_info)) 
{
     $book_sort_order = $book_info['sort_order'];
} 
else 
{
     $book_sort_order = 1;
}

if (isset($_POST['status'])) 
{
     $book_status = $_POST['status'];
} 
elseif (!empty($book_info)) 
{
     $book_status = $book_info['status'];
} 
else 
{
     $book_status = true;
}

if (isset($_POST['publisher_id'])) 
{
     $publisher_id = $_POST['publisher_id'];
} 
elseif (!empty($book_info)) 
{
     $publisher_id = $book_info['publisher_id'];
} 
else 
{
     $publisher_id = 0;
}
		
if (isset($_POST['publisher'])) 
{
    $publisher = $_POST['publisher'];
} 
elseif (!empty($book_info)) 
{
	$publisher_info = publisherGetById($book_info['publisher_id']);

	if ($publisher_info) 
	{
		 $publisher = $publisher_info['name'];
	} 
	else 
	{
		 $publisher = '';
	}
} 
else 
{
     $publisher = '';
}

if (isset($_POST['author_id']))
{
	$author_id = $_POST['author_id'];
}
elseif (!empty($book_info))
{
	$author_id = $book_info['author_id'];
}
else
{
	$author_id = 0;
}

if (isset($_POST['author']))
{
	$author = $_POST['author'];
}
elseif (!empty($book_info))
{
	$author_info = authorGetById($book_info['author_id']);

	if ($author_info)
	{
		$author = $author_info['name'];
	}
	else
	{
		$author = '';
	}
}
else
{
	$author = '';
}

if (isset($_POST['book_category'])) 
{
	$categories = $_POST['book_category'];
} 
elseif (isset($_GET['book_id'])) 
{
	$categories = bookGetCategories($_GET['book_id']);
} 
else 
{
	$categories = array();
}

$book_categories = array();
foreach ($categories as $category_id) 
{
	$category_info = categoryGetById($category_id);

	if ($category_info) 
	{
		$book_categories[] = array(
			'category_id' => $category_info['category_id'],
			'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
		);
	}
}

if (isset($_POST['book_related'])) 
{
	$books = $_POST['book_related'];
} 
elseif (isset($_GET['book_id'])) 
{
	$books = bookGetRelatedBooks($_GET['book_id']);
} 
else 
{
	$books = array();
}

$book_relateds = array();

foreach ($books as $book_id) 
{
	$related_info = bookGetById($book_id);

	if ($related_info) 
	{
		$book_relateds[] = array(
			'book_id' => $related_info['book_id'],
			'name'       => $related_info['name']
		);
	}
}


if (isset($_POST['book_image'])) 
{
	$images = $_POST['book_image'];
} 
elseif (isset($_GET['book_id'])) 
{	
	$images = bookGetImages($_GET['book_id']);
} 
else {	
	$images = array();
}

$book_images = array();
foreach ($images as $item) 
{
	if (is_file(DIR_IMAGE . $item['image'])) 
	{
		$image = $item['image'];
		$thumb = $item['image'];
	} 
	else 
	{
		$image = '';
		$thumb = 'no_image.png';
	}

	$book_images[] = array(
		'image'      => $image,
		'thumb'      => img_resize($thumb, 100, 100),
		'sort_order' => $item['sort_order']
	);
}

// Nội dung riêng của trang
$web_content = "../ui/admin/view/view-book-form.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

// Được đặt trong bố cục chung của toàn site
include_once FILE_LAYOUT_ADMIN;