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
require_once '../../../wp-config.php';
global $wpdb;
$status = $_POST['current'];
$post = $_POST['post'];
$post = $_POST['post'];
$val = $_POST['selected'];
$table = $wpdb->prefix."hfpl_record";
$query = "REPLACE INTO $table(hfpl_post_id, hfpl_status, hfpl_idx) VALUES('".$post."', '".$status."', '".$val."')";
$wpdb->query($query);

?>