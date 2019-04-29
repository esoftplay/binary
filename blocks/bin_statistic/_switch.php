<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Menampilkan daftar statistik dari member MLM, bs diurutkan berdasarkan downline terbanyak, sponsor terbanyak dan balance terbanyak

$statistic_title = array( 1 => 'Top Member', 2 => 'Top Income', 3 => 'Top Sponsor');
$statistic_field = array( 1 => 'total_downline', 2 => 'balance', 3 => 'total_sponsor');

$r_data = [];
foreach ((array)$config['cat'] as $cat)
{
	$r_data[] = $db->getAll("SELECT `username`, `name`, `location_name` FROM `bin` WHERE `active` = 1 ORDER BY `{$statistic_field[$cat]}` DESC LIMIT {$config['limit']}");
}

if (count($r_data) > 1)
{
	$is_multi_tipe = 1;
	$member_data   = $r_data;
}else{
	$is_multi_tipe = 0;
	$member_data   = !empty($r_data) ? array_chunk(reset($r_data), 5) : []; // setiap tampilan dilimit 4 jika total yang ditampilkan lebih dari 4 akan dijadikan slide
}

include tpl(@$config['template'].'.html.php', 'default.html.php');