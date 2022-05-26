<?php
//index.php
$error = '';


function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Your Name is important</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["dob"]))
 {
  $error .= '<p><label class="text-danger">Date of birth is required</label></p>';
 }
 else
 {
  $dob = clean_text($_POST["dob"]);
 }
 if(empty($_POST["gender"]))
 {
  $error .= '<p><label class="text-danger">Gender is required</label></p>';
 }
 else
 {
  $gender = clean_text($_POST["gender"]);
 }
 if(empty($_POST["country"]))
 {
  $error .= '<p><label class="text-danger">country is required</label></p>';
 }
 else
 {
  $country = clean_text($_POST["country"]);
 }
 if($error == '')
 {
  $file_open = fopen("userdata.csv", "a");
  $no_rows = count(file("userdata.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'dob' => $dob,
   'gender' => $gender,
   'country' => $country
  );
  fputcsv($file_open, $form_data);
  echo "Thank you $name for registering below are your details";
  echo "<br>";
  print_r($name); 
  echo "<br>";
  print_r($email); 
  echo "<br>";
  print_r($dob); 
  echo "<br>";
  print_r($gender); 
  echo "<br>";
  print_r($country); 
  echo "<br>";
//   $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $dob = '';
  $gender = '';
  $country = '';
 }
}

?>

