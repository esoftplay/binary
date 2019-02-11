<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea',  'bin_product_bundle_cat');
$form->initEdit(!empty($bundlecat_id) ? 'WHERE id='.$bundlecat_id : '');
$form->edit->setLanguage('bundle_cat_id');

if (!empty($bundlecat_id))
{
	$title = 'Edit Bundle Category';
}else{
	if (empty($sub_cat_id))
	{
		$title = 'Add Bundle Category';
	}else{
		$title = 'Add Bundle Sub Category';
	}
}
$form->edit->addInput('header','header');
$form->edit->input->header->setTitle($title);

$form->edit->addInput('title','text');
$form->edit->input->title->setTitle('Title / Nama Bundle Kategori');
$form->edit->input->title->setLanguage();
$form->edit->addExtrafield('name', @$_POST[$form->edit->input->title->name][lang_id()]);

$form->edit->addInput('icon', 'file');
$form->edit->input->icon->setTitle('Icon / Logo');
$form->edit->input->icon->setFolder($Bbc->mod['dir'].'bundle/');
$form->edit->input->icon->setAllowedExtension(array('jpg', 'jpeg', 'gif', 'png', 'bmp'));
$form->edit->input->icon->setResize(1080);
$form->edit->input->icon->setThumbnail(120, 'thumb', false);

$form->edit->addInput('keyword', 'textarea');
$form->edit->input->keyword->setTitle('Keyword / Kata Kunci');
$form->edit->input->keyword->setLanguage();

if (empty($bundlecat_id))
{
	$form->edit->addInput('orderby', 'orderby');
	$form->edit->input->orderby->setAddCondition('par_id='.$sub_cat_id);
}

$form->edit->addInput('active', 'checkbox');
$form->edit->input->active->setTitle('Status');
$form->edit->input->active->setCaption('active');

$form->edit->addExtrafield('par_id', $bundlecat_id);

$form->edit->action();
