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
$level_count = 0;
$group_count = 0;
if (empty($id))
{
	echo msg('Maaf, data yang anda akses bukan termasuk dalam jaringan anda', 'danger');
}else{
	$form = _lib('pea', 'bin_list_down_line');
	$form->initSearch();

	$form->search->addInput('position', 'select');
	$form->search->input->position->addOption([['', '--posisi--'], ['0', 'Kiri'], ['1', 'Kanan']]);

	$type_count = $db->cacheGetOne("SELECT COUNT(*) FROM `bin_serial_type` WHERE 1");
	if ($type_count > 1)
	{
		$form->search->addInput('serial_type_id', 'selecttable');
		// $form->search->input->serial_type_id->setTitle('Level');
		$form->search->input->serial_type_id->addOption('--Pilih Tipe--', '');
		$form->search->input->serial_type_id->setReferenceTable('bin_serial_type');
		$form->search->input->serial_type_id->setReferenceField( 'name', 'id' );
	}
	$level_count = $db->cacheGetOne("SELECT COUNT(*) FROM `bin_level` WHERE 1");
	if ($level_count > 1)
	{
		$form->search->addInput('level_id', 'selecttable');
		// $form->search->input->level_id->setTitle('Level');
		$form->search->input->level_id->addOption('--Pilih Peringkat--', '');
		$form->search->input->level_id->setReferenceTable('bin_level');
		$form->search->input->level_id->setReferenceField( 'name', 'id' );
	}else{
		$group_count = $db->cacheGetOne("SELECT COUNT(*) FROM `bbc_user_group` WHERE `is_admin`=0");
		if ($group_count > 2) // user group level
		{
			$arr = $db->getAll("SELECT `id`, `name` FROM `bbc_user_group` WHERE `is_admin`=0");
			$form->search->addInput('group_id', 'select');
			// $form->search->input->group_id->setTitle('Judul Field');
			$form->search->input->group_id->addOption('--Pilih Group--', '');
			$form->search->input->group_id->addOption($arr);
		}
	}

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('b.username, location_name, name', false);

	$form->search->addExtraField('bin_id', $Bbc->member['id']);

	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();
	echo $form->search->getForm();

	$tbl_line = 'bin_list_down_line';
	if (isset($keyword['position']))
	{
		$add_sql = preg_replace('~`position`=[0-9]+\s+AND\s+~is', '', $add_sql);
		$tbl_line = $keyword['position'] ? 'bin_list_down_right' : 'bin_list_down_left';
	}

	$table = '`bin` AS b LEFT JOIN `'.$tbl_line.'` AS d ON (d.`user_bin_id`=b.`id`)';
	if (!empty($keyword['group_id']) || $group_count > 2)
	{
		$add_sql = preg_replace('~\s`group_id`=([0-9]+)~s', ' `group_ids` LIKE \'%,$1,%\'', $add_sql);
		$table  .= ' LEFT JOIN `bbc_user` AS u ON (b.`user_id`=u.`id`)';
	}

	$form = _lib('pea',  $table);
	$form->initRoll($add_sql." ORDER BY list_id DESC", 'list_id');

	$form->roll->setSaveTool(false);
	$form->roll->setDeleteTool(false);

	$form->roll->addInput('username','sqlplaintext');
	$form->roll->input->username->setFieldName('b.username AS username');

	$form->roll->addInput('name','sqlplaintext');
	$form->roll->input->name->setTitle('Nama');

	$form->roll->addInput('position','sqlplaintext');
	$form->roll->input->position->setTitle('Posisi');
	$form->roll->input->position->setDisplayColumn(false);
	$form->roll->input->position->setDisplayFunction(function($a){
		return $a ? 'Kanan' : 'Kiri';
	});

	if ($type_count > 1)
	{
		$form->roll->addInput('serial_type_id', 'selecttable');
		$form->roll->input->serial_type_id->setTitle('Tipe');
		$form->roll->input->serial_type_id->setReferenceTable('bin_serial_type');
		$form->roll->input->serial_type_id->setReferenceField( 'name', 'id' );
		$form->roll->input->serial_type_id->setPlaintext(true);
		$form->roll->input->serial_type_id->setDisplayColumn(empty($keyword['serial_type_id']));
	}
	if ($level_count > 1)
	{
		$form->roll->addInput('level_id', 'selecttable');
		$form->roll->input->level_id->setTitle('Peringkat');
		$form->roll->input->level_id->setReferenceTable('bin_level');
		$form->roll->input->level_id->setReferenceField( 'name', 'id' );
		$form->roll->input->level_id->setPlaintext(true);
		$form->roll->input->level_id->setDisplayColumn(empty($keyword['level_id']));
	}
	if ($group_count > 2)
	{
		$form->roll->addInput('group_ids','multicheckbox');
		$form->roll->input->group_ids->setTitle('Group');
		$form->roll->input->group_ids->setReferenceTable('bbc_user_group');
		$form->roll->input->group_ids->setReferenceField('name', 'id');
		$form->roll->input->group_ids->setRelationTable(false);
		$form->roll->input->group_ids->setPlainText(true);
		$form->roll->input->group_ids->setDelimiter(', ');
	}

	$form->roll->addInput('depth_upline','sqlplaintext');
	$form->roll->input->depth_upline->setTitle('Kedalaman');
	$form->roll->input->depth_upline->setDisplayColumn(false);
	$form->roll->input->depth_upline->setDisplayFunction(function($a){
		global $Bbc;
		return money($a-$Bbc->member['depth_upline']);
	});

	$form->roll->addInput('depth_sponsor','sqlplaintext');
	$form->roll->input->depth_sponsor->setTitle('Generasi');
	$form->roll->input->depth_sponsor->setDisplayColumn(true);
	$form->roll->input->depth_sponsor->setDisplayFunction(function($a){
		global $Bbc;
		return money($a-$Bbc->member['depth_sponsor']);
	});

	$form->roll->addInput( 'created', 'datetime' );
	$form->roll->input->created->setTitle('Tanggal Join');
	$form->roll->input->created->setDateFormat('M jS, Y');
	$form->roll->input->created->setPlaintext(true);
	$form->roll->input->created->setDisplayColumn(false);

	echo $form->roll->getForm();
}