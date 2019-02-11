<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$id = @intval($_GET['id']);
$form = _lib('pea',  'bin_product_bundle');
$form->initEdit(!empty($id) ? 'WHERE id='.$id : '');

$form->edit->setLanguage('bundle_id');
$form->edit->setColumn(2);

$form->edit->addInput('header','header');
$form->edit->input->header->setTitle(!empty($id) ? 'Edit Bundle' : 'Add Bundle');

$form->edit->addInput('bundle_cat_id', 'selecttable');
$form->edit->input->bundle_cat_id->setTitle('Kategori Bundle');
$form->edit->input->bundle_cat_id->setReferenceTable('bin_product_bundle_cat ORDER BY orderby ASC');
$form->edit->input->bundle_cat_id->setReferenceField('name', 'id');
$form->edit->input->bundle_cat_id->setReferenceNested('par_id');
$form->edit->input->bundle_cat_id->setAllowNew(true);

$form->edit->addInput('sku', 'text');
$form->edit->input->sku->setTitle('SKU (Stock Keeping Unit) / Kode Bundle');
$form->edit->input->sku->setRequire('any', true);

$form->edit->addInput('images', 'multifile', 2);
$form->edit->input->images->setFolder($Bbc->mod['dir'].'bundle/'.$id.'/');
$form->edit->input->images->setResize(1920);
$form->edit->input->images->setThumbnail(250, 'thumb');
$form->edit->input->images->setFirstField('image');

$form->edit->addInput('title','text');
$form->edit->input->title->setTitle('Nama Barang');
$form->edit->input->title->setLanguage();
$form->edit->input->title->setRequire('any', true);
$form->edit->addExtrafield('name', @$_POST[$form->edit->input->title->name][lang_id()]);

$form->edit->addInput('keyword', 'textarea');
$form->edit->input->keyword->setTitle('Kata Kunci');
$form->edit->input->keyword->setLanguage();

$form->edit->addInput('description', 'textarea');
$form->edit->input->description->setTitle('Detail Product');
$form->edit->input->description->setHtmlEditor();
$form->edit->input->description->setLanguage();

$form->edit->addInput('weight', 'text', 2);
$form->edit->input->weight->setTitle('Berat (gram)');
$form->edit->input->weight->setRequire('number', true);
$form->edit->input->weight->setNumberFormat();

$form->edit->addInput('cost', 'text', 2);
$form->edit->input->cost->setTitle('Harga Pokok');
$form->edit->input->cost->setRequire('number', true);

$form->edit->addInput('price', 'text', 2);
$form->edit->input->price->setTitle('Harga Jual');
$form->edit->input->price->setRequire('number', true);

$form->edit->addInput('publish', 'checkbox', 2);
$form->edit->input->publish->setTitle('Status Jual');
$form->edit->input->publish->setCaption('Publish');
$form->edit->input->publish->setDefaultValue(1);

$form->edit->addInput('active', 'checkbox', 2);
$form->edit->input->active->setTitle('Status Barang');
$form->edit->input->active->setCaption('Tersedia');
$form->edit->input->active->setDefaultValue(1);

$form->edit->action();
echo $form->edit->getForm();