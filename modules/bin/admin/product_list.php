<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea',  'bin_product');
$form->initSearch();

_func('array');
$r = $db->getAll("SELECT `id`, `par_id`, `name` AS `title` FROM `bin_product_cat` WHERE 1 ORDER BY `name` ASC");
$form->search->addInput( 'cat_id', 'select' );
$form->search->input->cat_id->setTitle('Category');
$form->search->input->cat_id->addOption('--Pilih Kategori--', '');
$form->search->input->cat_id->addOption(array_path($r));

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('sku,name', false);

$add_sql = $form->search->action();
$keyword = $form->search->keyword();

echo $form->search->getForm();

$form->initRoll("{$add_sql} ORDER BY id DESC");

$form->roll->addInput('image','file');
$form->roll->input->image->setTitle('Image');
$form->roll->input->image->setFolder($Bbc->mod['dir'].'product/');
$form->roll->input->image->setFieldName("CONCAT(id,'/',image) AS image");
$form->roll->input->image->setImageClick();
$form->roll->input->image->setPlaintext(true);
$form->roll->input->image->setDisplayColumn(true);

$form->roll->addInput('sku','sqllinks');
$form->roll->input->sku->setTitle('SKU');
$form->roll->input->sku->setLinks($Bbc->mod['circuit'].'.product_list_edit');

$form->roll->addInput('name','sqlplaintext');
$form->roll->input->name->setTitle('Title');
$form->roll->input->name->setDisplayColumn(true);

$form->roll->addInput( 'cat_id', 'selecttable' );
$form->roll->input->cat_id->setTitle('Category');
$form->roll->input->cat_id->setReferenceTable('bin_product_cat');
$form->roll->input->cat_id->setReferenceField( 'name', 'id' );
$form->roll->input->cat_id->setDisplayColumn(false);

$form->roll->addInput('weight','sqlplaintext');
$form->roll->input->weight->setNumberFormat();
$form->roll->input->weight->setDisplayColumn(false);

$form->roll->addInput('stock','sqlplaintext');
$form->roll->input->stock->setNumberFormat();
$form->roll->input->stock->setDisplayColumn(true);

$form->roll->addInput('cost','sqlplaintext');
$form->roll->input->cost->setNumberFormat();
$form->roll->input->cost->setDisplayColumn(false);

$form->roll->addInput('price','sqlplaintext');
$form->roll->input->price->setNumberFormat();
$form->roll->input->price->setDisplayColumn(true);

$form->roll->addInput( 'publish', 'checkbox' );
$form->roll->input->publish->setTitle('Publish');
$form->roll->input->publish->setCaption('Jual');
$form->roll->input->publish->setDisplayColumn(false);

$form->roll->addInput( 'active', 'checkbox' );
$form->roll->input->active->setTitle('Status');
$form->roll->input->active->setCaption('Available');
$form->roll->input->active->setDisplayColumn(false);

$form->roll->action();
echo $form->roll->getForm();