<?php
global $post;
global $wpdb;
$hfpl_post = $post->ID;

$hfpl_status = $post->post_status;
$hfpl_table = $wpdb->prefix."hfpl_records";
$hfpl_query = "SELECT `hfpl_post_id` FROM `".$hfpl_table."` WHERE `hfpl_post_id` = '".$hfpl_post."' AND `hfpl_status` = 't' limit 1";
$hfpl_row = $wpdb->get_row($hfpl_query,ARRAY_A);
$hfpl_hasID = $hfpl_row['hfpl_post_id'];
?>
<div id="hfpl_main">
		<?php 
		if($hfpl_hasID != ""){
			echo "<input type='checkbox' name='hfpl_checkbox' id='hfpl_checkbox' checked />";
		}else{
			echo "<input type='checkbox' name='hfpl_checkbox' id='hfpl_checkbox' />";
		} _e(" Feature This Post?");
		echo "<p><a href='".get_settings('siteurl')."/wp-admin/options-general.php?page=Hungred Feature Post List'>Return to plugin admin page</a></p>";
		echo "<input type='hidden' name='hfpl_id' id='hfpl_id' value='".$hfpl_post."' />";
		echo "<input type='hidden' name='hfpl_status' id='hfpl_status' value='".$hfpl_status."' />";
		?>
</div>