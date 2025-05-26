<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<title>Eagle Tek Lite</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap');

body{
	justify-content: center;
	align-items: center;
}
input[type="text"],input[type="number"]{
	padding:8px;
	width:80%;
	margin-bottom:10px;
	height: 45px;
	border-radius:2px;
	border: 0.5px solid grey;
	
	
}

@import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
::root{
	--bg-color: #0b79ea;
}
body {
  font-family: "Roboto", sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #0b79ea;
  min-height: 80vh;
}
form{
	border: 1px solid grey;
	border-radius: 5px;
	align-items: center;
	justify-content: center;
	padding:10px;
}
.container {
  max-width: 400px;
  width: 100%;
  background: white;
  padding: 2rem;
  margin:2%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

@media(min-width: 970px){	
	
	input[type="file"],input[type="text"],input[type="number"]{
	padding:13px;
	width:80%;
	margin-bottom:25px;
	height: 65px;
	border-radius:2px;
	border: 2px solid grey;
	font-size: 18px;
	
}



	.container {
		align-items: center;
		justify-content: center;
  max-width: 850px;
  width: 100%;
  height: 750px;
  background: white;
  padding: 4rem;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.10);
}

.container .inputBox .form-control {
  border: 2px solid #eee;
  width: 100%;
  min-height: 70px;
  padding: 1rem;
  font-size: 1.9rem;
  color: #222;
  outline: none;
  transition: 0.3s;
}


}.msg_out{
	background: none;
	color: green;
	text-align: center;
	margin:10px;
	align: items: center;
	justify-content: center;
	
}

.container .title {
  font-size: 1.7rem;
  font-weight: 800;
  border-left: 0.3rem solid;
  padding-left: 0.5rem;
  color: #0b79ea;
  margin-bottom: 1rem;
  text-transform: uppercase;
  word-spacing: 4px;
}

.container .inputBox {
  margin-bottom: 1rem;
}

.container .inputBox:last-child {
  margin-bottom: 0;
}

.container .inputBox .form-label {
  display: block;
  font-weight: 500;
  font-size: 0.7rem;
  color: #222;
  margin-bottom: 0.3rem;
}

.container .inputBox .form-control {
  border: 1px solid #eee;
  width: 100%;
  min-height: 40px;
  padding: 1rem;
  font-size: 0.9rem;
  color: #222;
  outline: none;
  transition: 0.3s;
}

.container .inputBox .form-control:focus,
.container .inputBox .form-control:valid {
  border-color: #0b79ea;
}

.btn {
margin: 10px;
  border: none;
  outline: none;
  background: #0b79ea;
  padding: 0.7rem 2rem;
  color: white;
  font-weight: 500;
  font-size: 0.9rem;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  text-decoration: none;
  cursor: pointer;
}
.btn:hover{
	background:red;
}
input[type="file"]{
 border: 1px solid #eee;
  width: 100%;
  min-height: 40px;
  padding: 1rem;
  font-size: 0.9rem;
  color: #222;
  outline: none;
  transition: 0.3s;
  box-shadow: 5px 4px 5px black;
}
</style>
<link rel="stylesheet" href="style.css">

</head>
<body>
 <div class="container">
      <div class="remote-upload">
        <h2 class="title">Host Your Files</h2>

<?php

error_reporting(0);





if(!isset($_POST['submit'])){
	echo'
<form method="POST" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
<br>
		 <label for="number" class="form-label"></label><br>
 <input type="file" name="file" class="form-control" id="num" placeholder="" value=""required/><br>
 
<br><br>
 <input type="submit" name="submit" id="submit" class="btn" value="Upload"/> <input type="submit" name="delete" id="submit" class="btn" value="Delete"/>
	</form>
	';
}


if(isset($_POST['submit'])){ 

$errors= array(); 
$file_name = $_FILES['file']['name']; 
if(file_exists("files/".$file_name)){
	echo"File Name Already Exist<br> <br>Your Script Link :- <u><a target='_blank' href='http://techysubscribers.rf.gd/files/$file_name'><font color='green'>Click Here For Script Link</font></a></u>";
}else{
$file_size = $_FILES['file']['size']; $file_tmp = $_FILES['file']['tmp_name'];
$file_type = $_FILES['file']['type']; $file_ext=strtolower(end(explode('.',$_FILES['file']['name']))); $extensions= array("jpeg","jpg","png","gif","php","pdf","html","css");
 if(in_array($file_ext,$extensions)=== false)
{ $errors[]="extension not allowed."; } if($file_size > 2097152) { $errors[]='File size must be excately 2 MB'; } 
if(empty($errors)==true) { move_uploaded_file($file_tmp,"files/".$file_name); 
echo"File Uploaded Success!<br> <br>Your Script Link :- <u><a target='_blank' href='http://techysubscribers.rf.gd/files/$file_name'><font color='green'>Click Here For Script Link</font></a></u>"; }else{ print_r($errors); }
  }
   }
   
   if(isset($_POST['delete'])){
   	
$file_pointer = $file_name = $_FILES['file']['name']; 

   
// Use unlink() function to delete a file  

if (!unlink("files/".$file_pointer)) {  

    echo ("$file_pointer cannot be deleted due to an error");  
}  

else {  

    echo ("$file_pointer has been deleted");  
} 
   }
   
?>

        

     </div>
    </div>
</body>
</html>