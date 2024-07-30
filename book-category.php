<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.category.php';
include_once 'lib/table/table.book.php';
include_once 'lib/tool.image.php';

// Bắt các tham số trên url
if (isset($_REQUEST['filter'])) 
{
	$filter = $_REQUEST['filter'];
} 
else 
{
	$filter = '';
}

if (isset($_REQUEST['sort'])) 
{
	$sort = $_REQUEST['sort'];
} 
else 
{
	$sort = 'p.sort_order';
}

if (isset($_REQUEST['order'])) 
{
	$order = $_REQUEST['order'];
} 
else 
{
	$order = 'ASC';
}

if (isset($_REQUEST['page'])) 
{
	$page = $_REQUEST['page'];
} 
else 
{
	$page = 1;
}

if (isset($_REQUEST['limit'])) 
{
	$limit = $_REQUEST['limit'];
} 
else 
{
	$limit = settings('config_book_limit');
}
		
// Điều hướng ruột bánh mì
$breadcrumbs = array();

$breadcrumbs[] = array(
	'text' => '<i class="fa fa-home"></i> Trang Chủ',
	'href' => urlHome()
);
		
if (isset($_REQUEST['path'])) 
{
	$url = '';

	if (isset($_REQUEST['sort'])) 
	{
		$url .= '&sort=' . $_REQUEST['sort'];
	}

	if (isset($_REQUEST['order'])) 
	{
		$url .= '&order=' . $_REQUEST['order'];
	}

	if (isset($_REQUEST['limit'])) 
	{
		$url .= '&limit=' . $_REQUEST['limit'];
	}

	$path = '';

	$parts = explode('_', (string)$_REQUEST['path']);

	$category_id = (int)array_pop($parts);

	foreach ($parts as $path_id) 
	{
		if (!$path) 
		{
			$path = (int)$path_id;
		} 
		else 
		{
			$path .= '_' . (int)$path_id;
		}

		//$category_info = $objCategoryPublic->getCategory($path_id);
		$category_info = categoryGetById($path_id);

		if ($category_info) 
		{
			$breadcrumbs[] = array(
				'text' => $category_info['name'],
				'href' => urlBookCategory().'?path=' . $path . $url
			);
		}
	}
} 
else 
{
	$category_id = 0;
}
		
$category_info = categoryGetById($category_id);
		
$category_name = $category_info['name'];

$category_href = urlBookCategory().'?path='.$_REQUEST['path'];
			
// Set the last category breadcrumb
$breadcrumbs[] = array(
	'text' => $category_info['name'],
	'href' => urlBookCategory().'?path='.$_REQUEST['path']
);

if ($category_info['image']) 
{
	$category_thumb = img_resize($category_info['image'], settings('config_image_category_width'), settings('config_image_category_height'));
} 
else 
{
	$category_thumb = '';
}

$category_description = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			
$url = '';

if (isset($_['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
}

if (isset($_REQUEST['sort'])) 
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order'])) 
{
	$url .= '&order=' . $_REQUEST['order'];
}

if (isset($_REQUEST['limit'])) 
{
	$url .= '&limit=' . $_REQUEST['limit'];
}
			
$sub_categories = array();

$results = categoryGetAllByParent($category_id);

foreach ($results as $result) 
{
	$sub_categories[] = array(
		'name'  => $result['name'] . (settings('config_book_count') ? ' (' . bookGetTotalForCategory($result['category_id']) . ')' : ''),
		'href'  => urlBookCategory().'?path='.$result['category_id'],
		'category_id' => $result['category_id']
	);
}
			
$booksByCategory = array();

$filter_data = array(
	'filter_category_id' => $category_id,
	'filter_filter'      => $filter,
	'sort'               => $sort,
	'order'              => $order,
	'start'              => ($page - 1) * $limit,
	'limit'              => $limit
);

// @todo tính toán lại vì khi xem tất cả các sản phẩm của một category
// thì phải tính cả các category con của nó nữa.
$book_total = bookGetTotalForCategory($category_id);

$results = bookGetAllForCategory($filter_data);
			
foreach ($results as $result) 
{
	//if ($result['image']) 
	if (is_file(DIR_IMAGE . $result['image'])) 
	{
		$image = img_resize($result['image'], settings('config_image_book_width'), settings('config_image_book_height'));
	} 
	else 
	{
		$image = img_resize('placeholder.png', settings('config_image_book_width'), settings('config_image_book_height'));
	}

	$price = number_format($result['price'],0,'.',',').' ₫';
				

	$booksByCategory[] = array(
		'book_id'  => $result['book_id'],
		'thumb'       => $image,
		'name'        => $result['name'],
		'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_book_description_length')) . '..',
		'price'       => $price,
		'href'        => urlBookDetails().'?book_id=' . $result['book_id'] . $url  
	);
}
			
$url = '';

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
}

if (isset($_REQUEST['limit'])) 
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

$book_sorts = array();

$book_sorts[] = array(
	'text'  => "Mặc định",
	'value' => 'p.sort_order-ASC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.sort_order&order=ASC' . $url
);

$book_sorts[] = array(
	'text'  => "Tên (A - Z)",
	'value' => 'p.name-ASC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.name&order=ASC' . $url
);

$book_sorts[] = array(
	'text'  => "Tên (Z - A)",
	'value' => 'p.name-DESC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.name&order=DESC' . $url
);

$book_sorts[] = array(
	'text'  => "Giá (Thấp &gt; Cao)",
	'value' => 'p.price-ASC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.price&order=ASC' . $url
);

$book_sorts[] = array(
	'text'  => "Giá (Cao &gt; Thấp)",
	'value' => 'p.price-DESC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.price&order=DESC' . $url
);

$book_sorts[] = array(
	'text'  => "Model (A - Z)",
	'value' => 'p.model-ASC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.model&order=ASC' . $url
);

$book_sorts[] = array(
	'text'  => "Model (Z - A)",
	'value' => 'p.model-DESC',
	'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . '&sort=p.model&order=DESC' . $url
);
			
$url = '';

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
}

if (isset($_REQUEST['sort'])) 
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order'])) 
{
	$url .= '&order=' . $_REQUEST['order'];
}

$limits = array();

//$_limits = array_unique(array(settings('config_book_limit'), 25, 50, 75, 100));
$_limits = array_unique(array(5, 10, 15, 20, 25, 30, 35, 40));

sort($_limits);

foreach($_limits as $value) 
{
	$limits[] = array(
		'text'  => $value,
		'value' => $value,
		'href'  => urlBookCategory().'?path=' . $_REQUEST['path'] . $url . '&limit=' . $value
	);
}
			
// Phân trang
$url = urlBookCategory().'?path=' . $_REQUEST['path'];

if (isset($_REQUEST['filter'])) 
{
	$url .= '&filter=' . $_REQUEST['filter'];
}

if (isset($_REQUEST['sort'])) 
{
	$url .= '&sort=' . $_REQUEST['sort'];
}

if (isset($_REQUEST['order'])) 
{
	$url .= '&order=' . $_REQUEST['order'];
}

if (isset($_REQUEST['limit'])) 
{
	$url .= '&limit=' . $_REQUEST['limit'];
}
			
paginate($book_total, $page,$limit, $url);

// Nội dung riêng của trang...
$web_title = 'Loại Sản Phẩm';
$web_content = DIR_UI_HOME_THEMES."view/view-category.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site.
include_once FILE_LAYOUT_HOME;	
					
