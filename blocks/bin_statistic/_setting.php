<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$statistic_title = array( 1 => 'Top Member', 2 => 'Top Income', 3 => 'Top Sponsor');
$_setting = array(
	'cat'		=> array(
		'text'      => 'Tipe Statistik',
		'type'      => 'select',
		'is_arr'    => true,
		'option'    => $statistic_title,
		'tips'      => 'Silahkan pilih satu atau beberapa tipe statistik yang ingin ditampilkan. Jika dipilih lebih dari satu, tampilan akan menjadi tab.',
		'default'   => 'no',
		'help'      => 'Tekan `ctrl` + `click` untuk memilih lebih dari satu'
		),
	'limit'=> array(
		'text'		=> 'Total Tampilan',
		'type'		=> 'text',
		'default'	=> '10',
		'add'     => 'item',
		'tips'		=> 'Masukkan total tampilan daftar member untuk tiap tipe yang ingin ditampilkan pada block.'
		)
	);