<?php
// Cấu hình hệ thống
include_once '../configs.php';

// Thư viện hàm
include_once '../lib/tool.image.php';
include_once '../lib/table/table.banner.php';

		$url = '';

		if (isset($_GET['sort'])) {
			$url .= '&sort=' . $_GET['sort'];
		}

		if (isset($_GET['order'])) {
			$url .= '&order=' . $_GET['order'];
		}

		if (isset($_GET['page'])) {
			$url .= '&page=' . $_GET['page'];
		}

		if (!isset($_GET['banner_id'])) {
			$url_action = urlAdminBannerAdd();
		} else {
			$url_action = urlAdminBannerEdit() . '?banner_id=' . $_GET['banner_id'] . $url;
		}

		$url_cancel = urlAdminBanner();

		if (isset($_GET['banner_id']) && ($_SERVER['REQUEST_METHOD'] != "POST")) {
			$banner_info = bannerGetById($_GET['banner_id']);
		}

		if (isset($_POST['name'])) {
			$banner_name = $_POST['name'];
		} elseif (!empty($banner_info)) {
			$banner_name = $banner_info['name'];
		} else {
			$banner_name = '';
		}

		if (isset($_POST['status'])) {
			$banner_status = $_POST['status'];
		} elseif (!empty($banner_info)) {
			$banner_status = $banner_info['status'];
		} else {
			$banner_status = true;
		}

		if (isset($_POST['banner_image'])) {
			$_images = $_POST['banner_image'];
		} elseif (isset($_GET['banner_id'])) {
			$_images = bannerGetImages($_GET['banner_id']);
		} else {
			$_images = array();
		}

		$banner_images = array();

		foreach ($_images as $banner_image) {
			if (is_file(DIR_IMAGE . $banner_image['image'])) {
				$image = $banner_image['image'];
				$thumb = $banner_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$banner_images[] = array(
				'title'      => $banner_image['title'],
				'sub_title'  => $banner_image['sub_title'],
				'description'  => $banner_image['description'],
				'price'      => $banner_image['price'],
				'link'       => $banner_image['link'],
				'image'      => $image,
				'thumb'      => img_resize($thumb, 100, 100),
				'sort_order' => $banner_image['sort_order']
			);
		}

		$banner_placeholder = img_resize('no_image.png', 100, 100);

$web_title = "Banner";		
$web_content = "../ui/admin/view/view-banner-form.php";

checkFileLayout(FILE_LAYOUT_ADMIN, $web_content);

include_once FILE_LAYOUT_ADMIN;