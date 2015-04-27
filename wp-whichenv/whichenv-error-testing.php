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
TEST CASES:
*/

$optionKey = array('development','integration','qc','uat','production','testing','staging');
$stored_urls = array();
$cmpr_url = array();
$duplicate = false;
$empty = false;

if(get_option('url_standard')!='true') {
	//Store custom values if set to custom
	foreach($optionKey as $option) {
		$stored_urls[] = get_option( $option.'_env');
	}
	$cmpr_url = $stored_urls;

	//Compare all custom urs against values stored in stored_urls
	foreach($stored_urls as $url) {
		$i = 0;
		foreach($cmpr_url as $value ) {
			if(strcmp($url, $value)==0 && strcmp($url, '')!=0) { 
				$i++;
				if($i > 1) {
					$duplicate = true;
				}
			}if(strcmp($url, $value)==0 && strcmp($url, '')==0) { 
				$i++;
				if($i > 1 && $i < 7) {
					$empty = false;
				}
				if($i == 7) {
					$empty = true;
				}
			}
		}
	}

	if($duplicate || $empty) {	
		update_option('has_duplicate', 'true');
	}else{
		update_option('has_duplicate', 'false');
	}
}