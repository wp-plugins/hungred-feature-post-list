<?php
/*  Copyright 2009  Clay Lua  (email : clay@hungred.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
global $wpdb, $mode;
$error = "";
$table = $wpdb->prefix."hfpl_options";

if($_POST['hfpl_no_post'] != "")
{
//update the database with Replace instead of insert to avoid duplication data in the table
	$query = "REPLACE INTO $table(hfpl_option_id, hfpl_type, hfpl_no_post,hfpl_header,hfpl_header_class,hfpl_widget_class) 
	VALUES('1', '".$_POST['hfpl_type']."', '".$_POST['hfpl_no_post']."', '".$_POST['hfpl_header']."', '".$_POST['hfpl_header_class']."', '".$_POST['hfpl_widget_class']."')";
	$wpdb->query($query);

}

//retrieve new data
$query = "SELECT * FROM `".$table."` WHERE 1 AND `hfpl_option_id` = '1' limit 1";
$row = $wpdb->get_row($query,ARRAY_A);


?>
<div class="hfpl_wrap">
	<?php    echo "<h2>" . __( 'Hungred Feature Post List' ) . "</h2>"; ?>
	
	<form name="hfpl_form" id="hfpl_form" class="hfpl_admin" onsubmit="return validate()" enctype="multipart/form-data" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<?php    echo "<h4>" . __( 'Feature Settings' ) . "</h4>"; ?>
		<p><div class='label'><?php _e("Feature Header" ); ?></div><input type="text" id="hfpl_header" name="hfpl_header" value="<?php echo $row['hfpl_header']; ?>" size="20"></p>
		<p><div class='label'><?php _e("Feature WClass" ); ?></div><input type="text" id="hfpl_widget_class" name="hfpl_widget_class" value="<?php echo $row['hfpl_widget_class']; ?>" size="20"></p>
		<p><div class='label'><?php _e("Feature Number" ); ?></div><input type="text" id="hfpl_no_post" name="hfpl_no_post" value="<?php echo $row['hfpl_no_post']; ?>" size="20"></p>
		<p><div class='label'><?php _e("Feature Type: " ); ?>
		</div><SELECT name="hfpl_type">
		<?php 
		if($row['hfpl_type'] == "S"){ ?>
		<option selected value="S">Selected Only</option>
		<option value="R">Random Only</option>
		<option value="B">Both</option>
		<?php }else if($row['hfpl_type'] == "R"){?>
		<option value="S">Selected Only</option>
		<option selected value="R">Random Only</option>
		<option value="B">Both</option>
		<?php }else if($row['hfpl_type'] == "B"){?>
		<option value="S">Selected Only</option>
		<option value="R">Random Only</option>
		<option selected value="B">Both</option>
		<?php }?>
		</SELECT>
		</p>		
		
<?php    echo "<h4>" . __( 'Selected Feature Post' ) . "</h4>"; ?>
<table class="widefat post fixed" cellspacing="0">
	<thead>
	<tr>
<?php print_column_headers('edit'); ?>
	</tr>
	</thead>

	<tfoot>
	<tr>
<?php print_column_headers('edit', false); ?>
	</tr>
	</tfoot>

	<tbody>
<?php 
$table = $wpdb->prefix."hfpl_records";
$query = "SELECT * FROM `".$table."` WHERE 1 AND `hfpl_status` = 't'";
$row = $wpdb->get_results($query);
foreach ($row as $post) {
	$detail = get_post($post->hfpl_post_id, OBJECT);
	_post_row($detail, $comment_pending_count[$post->hfpl_post_id], $mode);
}

?>
	</tbody>
</table>



	
		<?php if($error != ""){?>
		<hr />
		<?php    echo "<h4>" . __( 'Feature Error Section' ) . "</h4>"; ?>
		<p><div class='label'>
		<h2><?php _e("Error Message: " ); ?></h2>
		</div>
		<div class="hfpl_red">
		<?php echo $error; ?>
		</div>
		</p>
		<?php }?>
		
		<p class="submit">
		</div><input type="submit" id="submit" value="<?php _e('Update Options' ) ?>" />
		</p>

		<hr />
		<h2><?php _e("Support" ); ?></h2>
		<p>
		Please visit <a href="http://hungred.com/2009/08/15/useful-information/wordpress-plugin-hungred-feature-post-list/">hungred.com</a> for any support enquiry or email <a href='clay@hungred.com'>clay@hungred.com</a>. You can also show your appreciation by saying 'Thanks' on the <a href='http://hungred.com/2009/08/15/useful-information/wordpress-plugin-hungred-feature-post-list/'>plugin page</a> or visits our sponsors on <a href="http://hungred.com/2009/08/15/useful-information/wordpress-plugin-hungred-feature-post-list/">hungred.com</a> to help us keep up with the maintanance. If you like this plugin, you can buy me a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=i_ah_yong%40hotmail%2ecom&lc=MY&item_name=Coffee&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted">coffee</a>! You can also support this development with the donation button. Thanks!
		<p>
<a href='http://www.pledgie.com/campaigns/6187'><img alt='Click here to lend your support to: Hungred Wordpress Development and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/6187.png?skin_name=chrome' border='0' /></a>
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="ppbutton" onclick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=i_ah_yong%40hotmail%2ecom&lc=MY&item_name=Support%20Hungred%20Feature%20Post%20List%20Development&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest');return false;">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</p>
		</p>
	</form>
</div>
<script type="text/javascript">
/*
Name: validate
Usage: use to validate the form upon user submission
Parameter: 	NONE
Description: use to validate all the basic inputs by the users
*/
function validate()
{
	var number = document.getElementById('hfpl_no_post');
	var height = document.getElementById('hfpl_height');

	if(isNumeric(number, "Invalid number found in feature number"))
	{
		return true;
	}
						
					
	return false;
	
}
/*
Name: isNumeric
Usage: use to validate width, height, space and gap text box
Parameter: 	elem: the DOM object of each element
			helperMsg: the pop out box message
Description: This is a simple method to check whether a given text box string contains 
			 numbers and '.' symbols
*/
function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9.]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
</script>
