<?php
if(isset($_POST['email'])) {


  function died($error) {
    echo "<script>alert('$error')</script>";
    // echo "<script>onclick=history.back(-1)</script>";
      die();
  }
  
  //Validate 4 standard fields fields

  if(!isset($_POST['email']))
    died('Please input your email address and submit.');  

  if(!isset($_POST['firstname']))
    died('Please input your first name and submit.');  

  if(!isset($_POST['lastname']))
    died('Please input your last name and submit.');  

  if(!isset($_POST['jobtitle']))
    died('Please input your job title and submit.'); 

  if(!isset($_POST['phone']))
    died('Please input your phone number and submit.'); 

  if(!isset($_POST['country']))
    died('Please input your country and submit.'); 

  if(!isset($_POST['cq_1']))
    died('Please input your answer for "Are you currently using or considering using Database-as-a-Service (DBaaS)?" and submit.'); 


  //Store fields in variables for easy use

  $email 			    = 	$_POST['email']; 			// required
  $firstname 			= 	$_POST['firstname']; 		// required
  $lastname 			= 	$_POST['lastname'];			// required
  $jobtitle 			= 	$_POST['jobtitle']; 		// required
  $phone 				= 	$_POST['phone']; 			// required
  $country				= 	$_POST['country']; 			// required
  $cq1	 				= 	$_POST['cq_1']; 			// required

  //If the CQ is for IBM and requires 3 checkboxes, use the line below to concatenate all 3 checkboxes together into 1 variable
  //Note: Make sure each checkbox has the property name="cb[]" -> creates the array of checkboxes cb
  
  $checkboxes = implode(', ', $_POST['checkbox']);
	
  //$checkboxes1 = implode(', ', $checkboxes1);
  //	
//	$checkboxes2 = $_POST['checkbox2'];
//		if($checkboxes2 == NULL)
//			died('Please acknowledge that you agree to our Terms of Use, Privacy Policy, and your information being shared with our sponsor, Quit Genius.');
//		else
//  	$checkboxes2 = implode(', ', $checkboxes2);

  //If the CQ has an option of 'Other (please specify)' and it is selected, use the lines below to ensure the field for other gets a value
  //$other_check = 'Other (please specify)'; //Make this value exactly what the value of the option for 'other' is
  //  $result = strcmp($cq1, $other_check);
  //
  //  if($result === 0){
  //    if(!isset($_POST['hip_other']) || empty($_POST['hip_other'])) {
  //      died('Please specify other.');  
  //    }
  //    else{
  //      $other = $_POST['hip_other'];
  //    }
  //  }

  //Validate that each variable is of proper form
  $error_message = '';
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= '\n* The Email Address field does not appear to be completed or valid.';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$firstname)) {
    $error_message .= '\n* The First Name field does not appear to be completed or valid.';
  }
  if(!preg_match($string_exp,$lastname)) {
    $error_message .= '\n* The Last Name field does not appear to be completed or valid.';
  }
  if(strlen($jobtitle) < 2) {
    $error_message .= '\n* The Job Title field does not appear to be completed or valid.';
  }
  if(strlen($phone) < 10) {
    $error_message .= '\n* The Phone Number field does not appear to be completed or valid.';
  }
  if(strlen($error_message) > 0) {
    $final_error_message .= $error_message . '\n\nPressing OK will return you to email form after a few seconds...';
	died($final_error_message);
  }

  //Setting the time up
	date_default_timezone_set('America/New_York');
	$date = date ("l, F jS, Y"); 
	$time = date ("h:i A"); 

  //Storing all of the data in a writeable array (NOTE: Make sure all standard form fields and CQ's are in the array)
  $a1 = array($date,$time,$email,$firstname,$lastname,$jobtitle,$phone,$country,$cq1,$checkboxes);
  $data = '"' . implode('","',$a1) . '"' . "\n";

  //Open the file for writing
  $file = "formdata/formdata.csv";
	$fh = fopen($file, "a") or die("ERROR: Couldn't open $file for writing!");
	fwrite($fh, $data) or die("ERROR: Couldn't write values to file!");

  //Close the file after writing
	fclose($fh);

?>


<html>
<head>

 <meta http-equiv="Content-Language" content="en-us">
 <meta http-equiv="Content-Type" content="text/html;charset=windows-1252">
 <!-- Place the full URL to the landing page below after url= -->
 <meta http-equiv="refresh" content="0;url=https://tlm-technology-2.com/mariadb/8515/1/files/mariadb.pdf">
 <title>Redirecting...</title>

</head>

<body>


</body>

</html>

<?php
}
?>