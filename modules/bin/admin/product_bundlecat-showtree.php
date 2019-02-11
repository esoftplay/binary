<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$q = "SELECT `id`, `par_id`, `name` AS `title` FROM `bin_product_bundle_cat` WHERE 1 ORDER BY `par_id`, `name` ASC";
$o = $db->GetAll($q);
$r = array();
foreach($o AS $d)
{
	$d['title'] = addslashes($d['title']);
	$d['title'] = ($bundlecat_id==$d['id']) ? '<span class=nodeSel>'.trim($d['title']).'</span>' : trim($d['title']);
	$d['link']	= $base_link.'&id='.$d['id'];
	$r[] = $d;
}
$title = array('Bundle Category', $base_link);
$config = array(
	'useIcons' => false
);
_func('tree');
echo tree_list($r, $title, $config);