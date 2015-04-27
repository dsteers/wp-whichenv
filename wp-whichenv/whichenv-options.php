<?php
/**
 * wp-which-environment
 */
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
 
*/
/*
WHAT THIS PAGE DOES:

Custom url data sent here to be insert into or removed from settings section in db.
*/


// Reset values to empty for RP3 standard check
$postData = array('development','integration','qc','uat','production','testing','staging');
if( ($_POST['url_standard'] == 'standard' )  ) { 
	update_option('url_standard', 'true');
	update_option('has_duplicate', 'false');
	foreach($postData as $post) {
		if ($_POST[$post]){
			update_option($post.'_env','','yes');
		}
	}
}

// Set custom url values 
if( ($_POST['url_standard'] == 'custom' ) ) { 
	update_option('url_standard', 'false');
	update_option('has_duplicate', 'false');
	foreach($postData as $post) {
		if ($_POST[$post]){
			update_option($post.'_env',$_POST[$post],'yes');
		}else {
			update_option($post.'_env','','yes');
		}
	}
}