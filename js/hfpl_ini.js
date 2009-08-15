jQuery(document).ready(function() {
	/*
Name: ajaxCall
Usage: use to update the status of the record
Parameter: 	calller: determine who are the caller

Description: use to update the status of the record
*/
function ajaxCall(status, id)
{
	jQuery.post("../wp-content/plugins/hungred-feature-post-list/hfpl_update.php", { current: status, post: id}, function(data){
  });
}
	jQuery("#hfpl_checkbox").click(function(){
		if(jQuery("#hfpl_status").attr('value') == 'publish' && jQuery("#hfpl_id").attr('value') != "")
		ajaxCall(jQuery(this).attr('checked'), jQuery("#hfpl_id").attr('value'));
		else
		{
			jQuery(this).attr('checked', false);
			alert('Post must be published before it can be featured');
		}
	});
	
});