<?php
$arr = explode('\\', __FILE__); include_once($_SERVER["DOCUMENT_ROOT"].'/'.$arr[3].'/configs.php');
function validateForm()
{
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

function validateRepair()
{
	
}
