<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($category_id))
{
	$list_title = 'Sub Category';
}else{
	$list_title = 'Product Category';
}

$form->initRoll("WHERE `par_id`={$category_id} ORDER BY `orderby` ASC");

$form->roll->setSaveTool(true);

$form->roll->addInput('icon', 'file');
$form->roll->input->icon->setTitle('Image');
$form->roll->input->icon->setFolder($Bbc->mod['dir'].'cat/');
$form->roll->input->icon->setImageClick();
$form->roll->input->icon->setPlaintext(true);

$form->roll->addInput('name','sqlplaintext');
$form->roll->input->name->setTitle('Title');

$form->roll->addInput('orderby', 'orderby');
$form->roll->input->orderby->setTitle('Ordered');

$form->roll->addInput('active', 'checkbox');
$form->roll->input->active->setTitle('Status');
$form->roll->input->active->setCaption('active');

$form->roll->onDelete('bin_product_cat_delete');

function bin_product_cat_delete($ids)
{
	global $db;
	$ids = bin_product_cat_recure($ids);
	ids($ids);
	$db->Execute("DELETE FROM `bin_product_cat` WHERE `id` IN ({$ids})");
}

function bin_product_cat_recure($ids, $output = array())
{
	global $db;
	if (!empty($ids))
	{
		$ids = is_array($ids) ? $ids : array($ids);
		$out = array_merge($output, $ids);
		$r   = $db->getCol("SELECT `id` FROM `bin_product_cat` WHERE `par_id` IN (".implode(',', $ids).") ");
		if (!empty($r))
		{
			return call_user_func_array(__FUNCTION__, [$r, $out]);
		}else{
			return array_merge($ids, $out);
		}
	}else{
		return array();
	}
}