<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($_GET['id']))
{
	$file  = _CACHE.$_GET['id'].'.json';
	$data  = file_read($file);
	$title = !empty($_GET['title']) ? $_GET['title'].'-' : '';
	unlink($file);
	_func('download', 'excel', $title.'Serial-'.date('Y-m-d'), json_decode($data, 1));
}
redirect('index.php?mod=bin.serial_active');