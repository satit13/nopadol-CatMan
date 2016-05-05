<?php
session_start(); 
if(isset($_SESSION['result'])){
							echo $_SESSION['result'];
							unset($_SESSION['result']);
							}
?>
<!DOCTYPE html>
<head>
	<title>Manage Category</title> 
    <meta name="viewport" content="width=device-width,maximum-scale=1.0" /> 
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />	
    
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<script>
function cnklogin(){
if(document.forms["login"]["username"].value== "" || document.forms["login"]["username"].value == null){
	alert("กรุณากรอกข้อมูล Username !!");
	document.forms["login"]["username"].focus();
	return false;
	}
	else if(document.forms["login"]["passwd"].value== "" || document.forms["login"]["passwd"].value == null){
	alert("กรุณากรอกข้อมูล Password !!");
	document.forms["login"]["passwd"].focus();
	return false;
	}
}
</script>
</head>
<body>
<div id="header"></div>

  
<!--  <div class="login_container" id='flippr'>

  <h3>Login ระบบจัดการ Category</h3>
  
  <form name="login" method='POST' id="theForm" action="require/connect_apilogin.php" onSubmit="return cnklogin()">
  <div  class="form_login"> <input type='text' id="username" name='username'class="form-control" placeholder='Username'></div>
  <br>
    <div  class="form_login"><input type='password' id='password' name='passwd' class="form-control" placeholder='Password'></div>
      
    <div class='login_bt'>
      <input type='submit' value='Login'>
    </div> 
  </form>
</div>-->


<div id="form-main">

  <div id="form-div">
  <img src="images/user.png" class="img ">
    <form class="form" name="login" method='POST' id="theForm" action="require/connect_apilogin.php" onSubmit="return cnklogin()">
      
      <p class="name">
        <input name="username" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Username" id="username" />
      </p>
      
      <p class="email">
        <input name="passwd" type="password" class="validate[required,custom[email]] feedback-input" id="password" placeholder="Password" />
      </p>
      
      
      
      <div class="submit">
        <input type="submit" value="Login" id="button-blue"/>
        <div class="ease"></div>
      </div>
    </form>
  </div>
  
  
</body>
</html>