<!--  DIY Module Builder By HostJars http://opencart.hostjars.com -->
<?  if ($switch) { ?>
<script type="text/javascript">
  VK.init({apiId: <? echo $widgetid; ?>, onlyWidgets: true});
</script>
<div id="vk_comments">&nbsp;</div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {<?
foreach($config_str as $type => $value)
{
	echo $type.':'.$value.',';
}
 ?>},<? echo $product_id; ?>);
</script>
<? } ?>
<!--  /DIY Module Builder By HostJars http://opencart.hostjars.com -->