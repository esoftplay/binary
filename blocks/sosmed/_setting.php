<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$_setting = array(
	'title'	=> array(
		'text'      => 'Title Account',
		'tips'      => 'Silahkan masukkan judul akun sosial media, dengan penghubung tanda koma (,) untuk memisahkan akun satu dengan yang lain',
		'type'      => 'textarea',
		'default'   => '',
		),
	'link'	=> array(
		'text'      => 'Link Account',
		'tips'      => 'Silahkan masukkan link akun sosial media, dengan penghubung tanda koma (,) untuk memisahkan akun satu dengan yang lain. Contoh: https://facebook.com/user/sample',
		'type'      => 'textarea',
		'default'   => '',
		),
	'icon'	=> array(
		'text'      => 'Icon Account',
		'tips'      => 'Silahkan masukkan icon font awesome / bootstrap icon akun sosial media, dengan penghubung tanda koma (,) untuk memisahkan akun satu dengan yang lain. Contoh: fa fa-facebook',
		'type'      => 'textarea',
		'default'   => '',
		)
	);