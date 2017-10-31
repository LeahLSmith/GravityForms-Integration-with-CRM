<?php
/*
Plugin Name: DebtPayPro Integration with GravityForms
Description: Integrates GravityForms with DebtPayPro
Version: 2.0
Author: Leah Smith
Author URI: 

*/


/********************************************************/
/*                        Actions                       */
/********************************************************/

add_action("gform_post_submission", "set_post_content", 10, 2);

function set_post_content($entry, $form){
	 //Gravity Forms has validated the data
	 //Custom Form Submitted via PHP will go here
	 // Get the IDs of the relevant fields and prepare an email message
	 $message = print_r($entry, true);
	 
	 // Wrap test if any lines are larger than 70 characters
	 $message = wordwrap($message, 70);
	 
	// Send me an email for debugging
	// mail('llsmithonline@gmail.com', 'Getting the Gravity Form Field IDs', $message);
 
	// Post the form to a specific URL to the desired CRM, in this case DebtPayPro
	function post_to_url($url, $data) {
		$fields = '';
		foreach($data as $key => $value) {
			$fields .= $key . '=' . $value . '&';
		}
 
		rtrim($fields, '&');
		$post = curl_init();
 
		 curl_setopt($post, CURLOPT_URL, $url);
		 curl_setopt($post, CURLOPT_POST, count($data));
		 curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		 curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		 $result = curl_exec($post);
		 curl_close($post);
	}
	
	// Handle the form differently based on form ID
	if($form["id"] == 1) { //FORM 1
		if (($entry["6"]) == 'Private') {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"			=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 			=> 	$entry["2"],
				"email" 			=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 1.1"
			);
post_to_url("<ENTER POST URL HERE>", $data);
		}  else {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"			=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 			=> 	$entry["2"],
				"email" 			=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 1.2"
			);
	post_to_url("<ENTER POST URL HERE>", $data);
		}
	
	
	
	} elseif($form["id"] == 2) { //FORM 2 
		if (($entry["6"]) == 'Private') {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"			=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 			=> 	$entry["2"],
				"email" 			=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 2.1"
			);
post_to_url("<ENTER POST URL HERE>", $data);
		}  else {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"		=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 		=> 	$entry["2"],
				"email" 		=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 2.2"
			);
post_to_url("<ENTER POST URL HERE>", $data);
		}
	
		
}elseif($form["id"] == 3) { //FORM 3
		if (($entry["6"]) == 'Private') {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"		=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 		=> 	$entry["2"],
				"email" 		=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 3.1"
			);
post_to_url("<ENTER POST URL HERE>", $data);
		}  else {
			$data = array(
				"loan_amount"		=>	$entry["7"],
				"loan_status_f"		=>	$entry["4"],
				"loan_type"		=>	$entry["6"],
				"first_name" 		=> 	$entry["1.3"],
				"last_name" 		=> 	$entry["1.6"],
				"phone" 		=> 	$entry["2"],
				"email" 		=>	$entry["3"],
				"lead_source" 		=> 	"Campaign 3.2"
			);
post_to_url("<ENTER POST URL HERE>", $data);
		}
		}
 else { //Do nothing since there are no other forms
}
}
?>