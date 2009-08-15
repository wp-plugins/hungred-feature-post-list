<?php
require_once '../../../wp-config.php';
global $wpdb;
$status = $_POST['current'];
$post = $_POST['post'];
$table = $wpdb->prefix."hfpl_records";
$query = "REPLACE INTO $table(hfpl_post_id, hfpl_status) VALUES('".$post."', '".$status."')";
$wpdb->query($query);

?>