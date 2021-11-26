<?php
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
    session_start();

    error_reporting(E_ALL & ~E_NOTICE);
    ob_start();
    include_once ("rmxQueryFunctions.php");
    include_once ("define_Gobal.php");


    $LineId = '';
	if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
		$LineId = $_GET['LineId'];        
	
    $CompanyCode = '';
    if (isset($_POST['CompanyCode']))
        $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode']))
        $CompanyCode = $_GET['CompanyCode'];
    

    include_once("rmxLogin.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="en-th">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

<style>

    body {font-family: Arial, Helvetica, sans-serif;}

    /* Full-width input fields */
    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .login_container {
        padding: 16px;
    }


    .login_container input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        color:#000;

    }

    .login_container label {
        color:#000;

    }

    .login_container  select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
        color:#000;
    }

    /* Set a style for all buttons */
    .login_container button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .login_container button:hover {
        opacity: 0.8;
    }



    .buttonline button {
        display: inline-block;
        background-color: #4CAF50;

        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width:100%;
        text-align: center;
    }

    .buttonline button:hover {
        opacity: 0.8;
        padding: 32px 16px;
    }


    .left
    {
        /* display: inline-block; */
        float:left;
        width:45%;
        padding: 5px;
    }

    .right
    {
        /* display: inline-block; */
        float:right;
        width:45%;
        padding: 5px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    .inner
    {
        display: inline-block;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 10px;
    }

    /* Modal Content/Box */
    .modal-content {
        padding-top: 2px;
        background-color: #fefefe;
        margin: 2% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 90%;
        height: 80%;/* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
    }
        
    @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 260px) {
        span.psw {
        display: block;
        float: none;
        }
        .cancelbtn {
        width: 90%;
        }

        .submitbtn {
        width: 45%;
        display: inline-block;
        }
    }


</style>


</head>
<body>


  
  <form class="modal-content animate" method="post" enctype="multipart/form-data" 
    autocomplete="off" action="frmlogin.php">
    

    <div class="login_container">
      <label for="txtLineId"><b>Line Id</b></label>
      <input type="text" placeholder="Enter Username" name="txtLineId" id="txtLineId" 
      value="<?php echo $LineId;?>"
      required>


      <label for="txtCompCode"><b>Company Code</b></label>
      <input type="text" placeholder="Enter Username" name="txtCompCode" id="txtCompCode" 
      value="<?php echo $CompanyCode;?>"
      required>


      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="txtLogin" id="txtLogin" required>


      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="txtPWD" id="txtPWD" required>
        
      <button type="submit"  name="btnLogin" id="btnLogin" >Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>

      <button type="button" onclick="document.getElementById('divLogin').style.display='none'" 
        style="background-color:#ff6666" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>


<script>
// Get the modal
var modal = document.getElementById('divLogin');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } 
}


/*
function btnLoginClick() {
	var sLogin = document.getElementById('txtLogin').value;
	var sPWD = document.getElementById('txtPWD').value;
		
	alert(sLogin + "," + sPWD); 
	
	
}
*/
</script>

</body>
</html>
