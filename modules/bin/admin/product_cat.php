<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

$category_id = @intval($_GET['id']);
$sub_cat_id  = 0;
if (isset($_GET['showtree']))
{
	$_SESSION['product_category_showtree'] = $_GET['showtree'] ? 1 : 0;
	redirect(seo_uri('showtree'));
}
/*=====================================================
 * FETCH ALL LANG...
 *====================================================*/
$r_lang = lang_assoc();
$base_link = $Bbc->mod['circuit'].'.'.$Bbc->mod['task'];

$tab_category = array();
if($category_id > 0)
{
	include 'product_cat-form.php';
	$tab_category[$title] = $form->edit->getForm();
	$sub_cat_id           = $category_id;
	$category_id          = 0;
}

include 'product_cat-form.php';
include 'product_cat-list.php';

$tab_category[$list_title] = $form->roll->getForm();
$tab_category[$title] = $form->edit->getForm();

$is_checked = @$_SESSION['product_category_showtree'] ? true : false;
$col        = $is_checked ? 9 : 12;
?>
<div class="col-md-<?php echo $col ?>">
	<div class="panel-heading">
		<h3 class="panel-title">
			<label><input type="checkbox" id="show_tree"<?php echo is_checked($is_checked); ?> /> Show Category Tree</label>
		</h3>
	</div>
	<?php echo tabs($tab_category); ?>
</div>
<script type="text/javascript">
	_Bbc(function($){
		$("#show_tree").on("click", function(e){
			e.preventDefault();
			var a = $(this).is(":checked") ? 1 : 0;
			document.location.href = document.location.href+"&showtree="+a
		})
	})
</script>
<?php
if ($is_checked)
{
	?>
	<div class="col-md-3">
		<?php
		include 'product_cat-showtree.php';
		?>
	</div>
	<?php
}