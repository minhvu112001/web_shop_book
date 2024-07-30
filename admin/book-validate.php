<?php
// cấu hình hệ thống
include_once '../configs.php';

function validateFormBook()
{
	if (empty($_POST['name']) || trim($_POST['name']) == "")
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng nhập tên sản phẩm !';
		return false;
	}
	
	if (empty($_POST['publisher_id']))
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng chọn nhà xuất bản !';
		return false;
	}
	
	if (empty($_POST['author_id']) || (int)$_POST['author_id']==0)
	{
		$_SESSION['ERROR_TEXT'] = 'Bạn vui lòng chọn tác giả !';
		return false;
	}
	
	return true;
}

function validateDelete()
{
	return true;
}

function validateCopy()
{
	return true;
}