<?php

/*
WHAT THIS PAGE DOES:

This page is merely for constructing the html form within the admin tools section.
The form will post to the whichenv-options page where the data will be stored and reset.
*/


// Declaring variables for input values
$development_env = '';
$integration_env = '';
$qc_env = '';
$uat_env = '';
$production_env = '';
$testing_env = '';
$staging_env = '';

 
// Array of custom url types
$optionKey = array('development','integration','qc','uat','production','testing','staging');


// Loop through the get options variables and set the values to the inputs if they have any
foreach($optionKey as $option) {
	${$option.'_env'} = get_option( $option.'_env');
}

echo 
	'
	<div class="whichenv">
		<div class="row">
			<h1>Whichenv Settings</h1>
			<p>The Which Environment plugin allows the user to differentiate between multiple 
			wordpress environments by adding visual indicators to the admin bar.</p>
		</div>
		<div class="row">
			<form method="post" action="'.get_admin_url().'tools.php?page=whichenv-options" class="url_options">
				<div class="row"> ';

if(get_option('url_standard')!='false') {
	echo '<input type="radio" class="url_standard" name="url_standard" value="standard" checked> Assume RP3 standard<br>
		<p>Checking this box will automate the url screening process which expects a company specific naming convention.
		Unless you are certain that your urls follow this convention, it is advised to enter the specific unique values below.</p>
		<input type="radio" class="url_custom" name="url_standard" value="custom" > Use Custom url<br>';
}else {
		echo '<input type="radio" class="url_standard" name="url_standard" value="standard"> Assume RP3 standard<br>
			<p>Checking this box will automate the url screening process which expects a company specific naming convention.
			Unless you are certain that your urls follow this convention, it is advised to enter the specific unique values below.</p>
			<input type="radio" class="url_custom" name="url_standard" value="custom" checked> Use Custom url<br>';
}
					
echo '</div>
		<div class="urls">
					<span>Development</span> <input type="text" name="development" value="'.$development_env.'" ><br>
					<p>Generally your local development environment. This is your personal testing environment where breaking things is ok! so 
					feel free to experiment a little!</p>

					<span>Integration</span> <input type="text" name="integration" value="'.$integration_env.'" ><br>
					<p>Your merging site. This will be where you move your first round products to merge them in with other versions or team member"s code</p>

					<span>Quality Control</span> <input type="text" name="qc" value="'.$qc_env.'" ><br>
					<p>Lorem ipsum dolor sit amet adipiscicing consecteteur el. Amit falicitatus corporeal magnus opum.
					 Livin la vida loca con cervesa y taquitos.</p>

					<span>UAT</span> <input type="text" name="uat" value="'.$uat_env.'" ><br>
					<p>Lorem ipsum dolor sit amet adipiscicing consecteteur el. Amit falicitatus corporeal magnus opum.
					 Livin la vida loca con cervesa y taquitos.</p>
				</div>
				<div class="urls">
					<span>Production</span> <input type="text" name="production" value="'.$production_env.'" ><br>
					<p>Lorem ipsum dolor sit amet adipiscicing consecteteur el. Amit falicitatus corporeal magnus opum.
					 Livin la vida loca con cervesa y taquitos.</p>

					<span>Testing</span> <input type="text" name="testing" value="'.$testing_env.'" ><br>
					<p>Lorem ipsum dolor sit amet adipiscicing consecteteur el. Amit falicitatus corporeal magnus opum.
					 Livin la vida loca con cervesa y taquitos.</p>

					<span>Staging</span> <input type="text" name="staging" value="'.$staging_env.'" ><br>
					<p>Lorem ipsum dolor sit amet adipiscicing consecteteur el. Amit falicitatus corporeal magnus opum.
					 Livin la vida loca con cervesa y taquitos.</p>
				</div>
				<input type="submit" class="button button-primary" value="Save">
			</form>
		</div>
	</div>
	';
