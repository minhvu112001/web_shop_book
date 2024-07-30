<?php
function validateModule()
{
	if ((utf8_strlen($_POST['name']) < 3) || (utf8_strlen($_POST['name']) > 64)) 
	{
		$_SESSION['ERROR_TEXT'] = 'Tên module phải tối thiểu là 3 kí tự và không quá 64 kí tự';
		return false;
	}
		
	if (!$_POST['width']) 
	{
		$_SESSION['ERROR_TEXT'] = 'Phải có độ rộng';
		return false;
	}
		
	if (!$_POST['height']) 
	{
		$_SESSION['ERROR_TEXT'] = 'Phải có độ cao';
		return false;
	}

	return true;
}
