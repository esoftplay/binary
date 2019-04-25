<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Menampilkan link sosial media website
$sosmed_title = preg_split('~,\s{0,}~', $config['title']);
$sosmed_link  = preg_split('~,\s{0,}~', $config['link']);
$sosmed_icon  = preg_split('~,\s{0,}~', $config['icon']);
$sosmed       = array();

foreach ($sosmed_title as $key => $value)
{
	$sosmed[] = array(
								'title' => $value,
								'link'  => $sosmed_link[$key], 
								'icon'  => $sosmed_icon[$key]
							); 
}

include tpl(@$config['template'].'.html.php', 'header.html.php');
