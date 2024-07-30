<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.category.php';
include_once 'lib/table/table.book.php';
include_once 'lib/tool.image.php';

if (isset($_REQUEST['search'])) 
{
	$search = $_REQUEST['search'];
} 
else 
{
	$search = '';
}
		
if (isset($_REQUEST['tag'])) 
{
	$tag = $_REQUEST['tag'];
} 
elseif (isset($_REQUEST['search'])) 
{
	$tag = $_REQUEST['search'];
} 
else 
{
	$tag = '';
}

if (isset($_REQUEST['description'])) 
{
	$description = $_REQUEST['description'];
} 
else 
{
	$description = '';
}
		
// Trật tự sắp xếp
if (isset($_REQUEST['sort'])) 
{
	$sort = $_REQUEST['sort'];
} 
else 
{
	$sort = 'p.sort_order';
}

// Tăng giảm ?
if (isset($_REQUEST['order'])) 
{
	$order = $_REQUEST['order'];
} 
else 
{
	$order = 'ASC';
}
		
// Trang yêu cầu
if (isset($_REQUEST['page'])) 
{
	$page = $_REQUEST['page'];
} 
else 
{
	$page = 1;
}
		
// Giới hạn số phần tử trên trang
if (isset($_REQUEST['limit'])) 
{
	$limit = $_REQUEST['limit'];
} 
else 
{
	$limit = settings('config_book_limit');
}
		
if (isset($_REQUEST['search'])) 
{
	$search_title =  'Tìm kiếm'.  ' - ' . $_REQUEST['search'];
} 
elseif (isset($_REQUEST['tag'])) 
{
	$search_title =  'Tìm kiếm'.  ' - ' . 'heading_tag' . $_REQUEST['tag'];
} 
else 
{
	$search_title = 'Tìm kiếm';
}
		
$breadcrumbs = array();

$breadcrumbs[] = array(
	'text' => '<i class="fa fa-home"></i> Trang Chủ',
	'href' => urlHome()
);
		
$url = '?';

if (isset($_REQUEST['search'])) 
{
	$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['tag'])) 
{
	$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
}

if (isset($_REQUEST['description'])) 
{
	$url .= '&description=' . $_REQUEST['description'];
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

if (isset($_REQUEST['limit'])) 
{
	$url .= '&limit=' . $_REQUEST['limit'];
}

$breadcrumbs[] = array(
	'text' => 'Tìm kiếm',
	'href' => urlSearch().$url
);

$url_search = urlSearch().$url;
$search_url = $url_search;

		
// 3 Level Category Search

$booksSearched = array();

if (isset($_REQUEST['search']) || isset($_REQUEST['tag'])) 
{
	$filter_data = array(
		'filter_name'         => $search,
		'filter_tag'          => $tag,
		'filter_description'  => $description,
		'sort'                => $sort,
		'order'               => $order,
		'start'               => ($page - 1) * $limit,
		'limit'               => $limit
	);
			
	$book_total = bookGetTotalForSearch($filter_data);

	$results = bookGetAllForSearch($filter_data);
			
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

		$booksSearched[] = array(
			'book_id'  => $result['book_id'],
			'thumb'       => $image,
			'name'        => $result['name'],
			'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_book_description_length')) . '..',
			'price'       => $price,
			'href'        => urlBookDetails().'?book_id=' . $result['book_id'] 
		);
	}// end foreach
			
	$url = '';

	if (isset($_REQUEST['search'])) 
	{
		$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['tag'])) 
	{
		$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['description'])) 
	{
		$url .= '&description=' . $_REQUEST['description'];
	}

	if (isset($_REQUEST['category_id'])) 
	{
		$url .= '&category_id=' . $_REQUEST['category_id'];
	}

	if (isset($_REQUEST['sub_category'])) 
	{
		$url .= '&sub_category=' . $_REQUEST['sub_category'];
	}

	if (isset($_REQUEST['limit'])) 
	{
		$url .= '&limit=' . $_REQUEST['limit'];
	}
			
	// Tiêu chí sắp xếp
	$search_sorts = array();
	$search_sorts[] = array(
		'text'  => "Mặc định",
		'value' => 'p.sort_order-ASC',
		'href'  => urlSearch().'?sort=p.sort_order&order=ASC' . $url
	);

	$search_sorts[] = array(
		'text'  => "Tên (A - Z)",
		'value' => 'p.name-ASC',
		'href'  => urlSearch().'?sort=p.name&order=ASC' . $url
	);

	$search_sorts[] = array(
		'text'  => "Tên (Z - A)",
		'value' => 'p.name-DESC',
		'href'  => urlSearch().'?sort=p.name&order=DESC' . $url
	);

	$search_sorts[] = array(
		'text'  => "Giá (Thấp &gt; Cao)",
		'value' => 'p.price-ASC',
		'href'  => urlSearch().'?sort=p.price&order=ASC' . $url
	);

	$search_sorts[] = array(
		'text'  => "Giá (Cao &gt; Thấp)",
		'value' => 'p.price-DESC',
		'href'  => urlSearch().'?sort=p.price&order=DESC' . $url
	);
			
	$search_sorts[] = array(
		'text'  => "Model (A - Z)",
		'value' => 'p.model-ASC',
		'href'  => urlSearch().'?sort=p.model&order=ASC' . $url
	);

	$search_sorts[] = array(
		'text'  => "Model (Z - A)",
		'value' => 'p.model-DESC',
		'href'  => urlSearch().'?sort=p.model&order=DESC' . $url
	);
			
	// Giới hạn phân trang ----------------------------------
	$url = '?';

	if (isset($_REQUEST['search'])) 
	{
		$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['tag'])) 
	{
		$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['description'])) 
	{
		$url .= '&description=' . $_REQUEST['description'];
	}

	if (isset($_REQUEST['category_id'])) 
	{
		$url .= '&category_id=' . $_REQUEST['category_id'];
	}

	if (isset($_REQUEST['sub_category'])) 
	{
		$url .= '&sub_category=' . $_REQUEST['sub_category'];
	}

	if (isset($_REQUEST['sort'])) 
	{
		$url .= '&sort=' . $_REQUEST['sort'];
	}

	if (isset($_REQUEST['order'])) 
	{
		$url .= '&order=' . $_REQUEST['order'];
	}
			
	$search_limits = array();

	//$_limits = array_unique(array(settings('config_book_limit'), 25, 50, 75, 100));
	$_limits = array_unique(array(5, 10, 15, 20, 25, 30, 35, 40));

	sort($_limits);

	foreach($_limits as $value) 
	{
		$search_limits[] = array(
			'text'  => $value,
			'value' => $value,
			'href'  => urlSearch().'?limit='.$value . $url
		);
	}
			
	// Phân trang
	$url = urlSearch().'?';

	if (isset($_REQUEST['search'])) 
	{
		$url .= '&search=' . urlencode(html_entity_decode($_REQUEST['search'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['tag'])) 
	{
		$url .= '&tag=' . urlencode(html_entity_decode($_REQUEST['tag'], ENT_QUOTES, 'UTF-8'));
	}

	if (isset($_REQUEST['description'])) 
	{
		$url .= '&description=' . $_REQUEST['description'];
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
	
}

// Nội dung riêng của trang...
$web_title = "Tìm kiếm";
$web_content = DIR_UI_HOME_THEMES."view/view-search.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site
include_once FILE_LAYOUT_HOME;	
