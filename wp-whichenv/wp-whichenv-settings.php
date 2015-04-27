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
$read_only = 'readonly';
 
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
			<form method="post" action="'.get_admin_url().'tools.php?page=Which-Environment-Settings" class="url_options">
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

			$read_only = '';
}
					
echo '</div>
		<div class="urls">
					<span>Development</span> <input type="text" name="development" value="'.$development_env.'" '.$read_only.' ><br>
					<p>The development environment"s hostname will be identical on every developer"s system through the use of vagrant
					 hostmanager. This will be your local dev environment and changes made here will not be seen by others until pushed 
					 to intdev.project.client.rp3dev.com.</p>

					<span>Integration</span> <input type="text" name="integration" value="'.$integration_env.'" '.$read_only.'  ><br>
					<p>Special case. Integration environments are the output of pre-QC systems integration, such as the output of a Continuous 
					Integration service or the integration of multiple independent applications.</p>

					<span>Quality Control</span> <input type="text" name="qc" value="'.$qc_env.'" '.$read_only.' ><br>
					<p>Internal quality control environment.</p>

					<span>UAT</span> <input type="text" name="uat" value="'.$uat_env.'" '.$read_only.' ><br>
					<p>Client-facing testing environment for acceptance and sign-off. </p>
				</div>
				<div class="urls">
					<span>Production</span> <input type="text" name="production" value="'.$production_env.'" '.$read_only.' ><br>
					<p>Launched projects will obviously have as canonical the final URL, but will also have a CNAME alias the follows 
					the above format.</p>

					<span>Testing</span> <input type="text" name="testing" value="'.$testing_env.'" '.$read_only.' ><br>
					<p>Content testing environment</p>

					<span>Staging</span> <input type="text" name="staging" value="'.$staging_env.'" '.$read_only.' ><br>
					<p>Content staging environment</p>
				</div>
				<input type="submit" class="button button-primary" value="Save">
			</form>
		</div>

		<div class="row">
			<p><strong>*** Warning alerts will occur for one of three reasons ***</strong></p>
			<ul>
				<li>1. Duplicate custom urls</li>
				<li>2. All empty custom fields while custom option selected</li>
				<li>3. Current url does not match custom urls or RP3 url standards</li>
			</ul>
		</div>
	</div>
	';
