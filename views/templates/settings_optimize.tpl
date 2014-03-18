<?
use oat\tao\helpers\Template as _tpl;

if(get_data('message')):?>
	<div id="info-box" class="ui-corner-all auto-highlight auto-hide">
		<?=get_data('message')?>
	</div>
<?endif?>

<?
if (get_data('optimizable')) {
    include('optimize.tpl'); 
}
?>

<?_tpl::inc('footer.tpl', 'tao')?>

<script type="text/javascript">
$(function(){
	$("#section-meta").empty();
	<?if(get_data('reload')):?>
		window.location.reload();
	<?endif?>
});
</script>