<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$id = @intval($_GET['id']);
if (empty($id))
{
	$id = $Bbc->member['id'];
}else{
	if ($id!=$Bbc->member['id'] && !bin_isDownline($id, $Bbc->member['id']))
	{
		$id = 0;
	}
}
if (empty($id))
{
	echo msg('Maaf, data yang anda akses bukan termasuk dalam jaringan anda', 'danger');
}else{
	$type_id = @intval($_GET['type_id']);

	$form = _lib('pea',  'bin_balance');
	$form->initSearch();

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('title,description,amount', false);

	if (!empty($type_id))
	{
		$form->search->addExtraField('type_id', $type_id);
	}
	$form->search->addExtraField('bin_id', $id);
	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();

	echo $form->search->getForm();


	$form = _lib('pea',  'bin_balance');
	$form->initRoll("{$add_sql} ORDER BY id DESC");

	$form->roll->setSaveTool(false);
	$form->roll->setDeleteTool(false);

	if (empty($type_id))
	{
		$title = 'History Saldo';
	}else{
		$title = $db->getOne("SELECT name FROM `bin_balance_type` WHERE `id`={$type_id}");
	}
	$sys->nav_add($title);
	$form->roll->addInput('header', 'header');
	$form->roll->input->header->setTitle($title);

	$form->roll->addInput('ondate', 'sqlplaintext');
	$form->roll->input->ondate->setTitle(lang('Tanggal'));
	$form->roll->input->ondate->setDateFormat();

	$form->roll->addInput('title','sqlplaintext');
	$form->roll->input->title->setTitle(lang('Title'));

	$form->roll->addInput('amount', 'sqlplaintext');
	$form->roll->input->amount->setTitle(lang('Amount'));
	$form->roll->input->amount->setNumberFormat();

	$form->roll->action();
	echo $form->roll->getForm();
}