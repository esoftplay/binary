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
	$form = _lib('pea', 'bin_list_down_line');
	$form->initSearch();

	$form->search->addInput('position', 'select');
	$form->search->input->position->addOption([['', '--posisi--'], ['0', 'Kiri'], ['1', 'Kanan']]);

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('username, location_name, name', false);

	$form->search->addExtraField('bin_id', $Bbc->member['id']);

	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();
	echo $form->search->getForm();

	$form = _lib('pea',  'bin AS b LEFT JOIN bin_list_down_line AS d ON (d.user_bin_id=b.id)');
	$form->initRoll($add_sql." ORDER BY list_id DESC");

	$form->roll->setSaveTool(false);
	$form->roll->setDeleteTool(false);

	$form->roll->addInput('username','sqlplaintext');

	$form->roll->addInput('name','sqlplaintext');
	$form->roll->input->name->setTitle('Nama');

	$form->roll->addInput('position','sqlplaintext');
	$form->roll->input->position->setTitle('Posisi');
	$form->roll->input->position->setDisplayColumn(false);
	$form->roll->input->position->setDisplayFunction(function($a){
		return $a ? 'Kanan' : 'Kiri';
	});

	$form->roll->addInput('level_id', 'selecttable');
	$form->roll->input->level_id->setTitle('Peringkat');
	$form->roll->input->level_id->setReferenceTable('bin_level');
	$form->roll->input->level_id->setReferenceField( 'name', 'id' );
	$form->roll->input->level_id->setPlaintext(true);

	$form->roll->addInput('depth_upline','sqlplaintext');
	$form->roll->input->depth_upline->setTitle('Kedalaman');
	$form->roll->input->depth_upline->setDisplayFunction(function($a){
		global $Bbc;
		return money($a-$Bbc->member['depth_upline']);
	});

	$form->roll->addInput( 'created', 'datetime' );
	$form->roll->input->created->setTitle('Tanggal Join');
	$form->roll->input->created->setDateFormat('M jS, Y');
	$form->roll->input->created->setPlaintext(true);
	$form->roll->input->created->setDisplayColumn(false);

	echo $form->roll->getForm();
}