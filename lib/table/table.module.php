<?php
function moduleAdd($code, $data) 
{
	$name = db_escape($data['name']);
	$code = db_escape($code);
	$setting = db_escape(serialize($data));
	
	$sql = " 
		INSERT INTO `module` 
		SET `name` = '{$name}',
			`code` = '{$code}', 
			`setting` = '{$setting}'
	";
	
	db_q($sql);
}
	
function moduleEdit($module_id, $data) 
{
	$name = db_escape($data['name']);
	$setting = db_escape(serialize($data));
	$mid = (int)$module_id;
	
	$sql = " 
		UPDATE `module` 
		SET `name` = '{$name}', 
			`setting` = '{$setting}' 
		WHERE `module_id` = '{$mid}'
	";
	db_q($sql);
}
	
function moduleGetById($module_id) 
{
	$sql = "SELECT * FROM `module` WHERE `module_id` = '" . db_escape($module_id) . "'";
		
	$query = db_row($sql);

	if ($query) 
	{
		return unserialize($query['setting']);
	} 
	
	return array();	
}
	
function moduleGetByCode($module_code) 
{
		$sql = "SELECT * FROM `module` WHERE `code` = '" . db_escape($module_code) . "'";
		
		$query = db_row($sql);

		if ($query) 
		{
			return unserialize($query['setting']);
		}
		
		return array();	
}
	
function moduleGetAllByCode($code) 
{
	$sql = "SELECT * FROM `module` WHERE `code` = '" . db_escape($code) . "' ORDER BY `name`";
		
	return db_q($sql);
}
