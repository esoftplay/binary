<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

$bundlecat_id = @intval($_GET['id']);
$sub_cat_id  = 0;
if (isset($_GET['showtree']))
{
	$_SESSION['bundlecat_showtree'] = $_GET['showtree'] ? 1 : 0;
	redirect(seo_uri('showtree'));
}
/*=====================================================
 * FETCH ALL LANG...
 *====================================================*/
$r_lang = lang_assoc();
$base_link = $Bbc->mod['circuit'].'.'.$Bbc->mod['task'];

$bundlecat = array();
if($bundlecat_id > 0)
{
	include 'product_bundlecat-form.php';
	$bundlecat[$title] = $form->edit->getForm();
	$sub_cat_id        = $bundlecat_id;
	$bundlecat_id      = 0;
}

include 'product_bundlecat-form.php';
include 'product_bundlecat-list.php';

$bundlecat[$list_title] = $form->roll->getForm();
$bundlecat[$title] = $form->edit->getForm();

$is_checked = @$_SESSION['bundlecat_showtree'] ? true : false;
$col        = $is_checked ? 9 : 12;
?>
<div class="col-md-<?php echo $col ?>">
	<div class="panel-heading">
		<h3 class="panel-title">
			<label><input type="checkbox" id="show_tree"<?php echo is_checked($is_checked); ?> /> Show bundlecat Tree</label>
		</h3>
	</div>
	<?php echo tabs($bundlecat); ?>
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
		include 'product_bundlecat-showtree.php';
		?>
	</div>
	<?php
}