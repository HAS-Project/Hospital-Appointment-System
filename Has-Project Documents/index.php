
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<title></title>
	<script type="text/javascript">var max_chars = 11;

$(document).keydown( function(e){
    if ($('#tc').val().length >= max_chars) { 
        $('#tc').val($('#tc').val().substr(0, max_chars));
    }
});

$(document).keyup( function(e){
    if ($('#tc').val().length >= max_chars) { 
        $('#tc').val($('#tc').val().substr(0, max_chars));
    }
});
    </script>
</head>
<body>
      
      
     
         
         
      </div> 
      
      <div class = "container">
      
       <div class="row">

       	  <div class="col-12 search-box">
       	  	<h2>Enter Username and Password</h2> </br>
         <form class = "form-signin" role = "form" 
            action = "login.php" method = "post">
            <h4 class = "form-signin-heading"></h4>
            <input type = "number" class = "form-control" id="tc"  maxlength="11" size="11"
               name = "tc" placeholder = "Tc" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "sifre" required></br>


            <button class = "btn btn-lg btn-primary " type = "submit" 
               name = "login" style="color:white;">Login</button>


               
         </form></br>
			 <button class = "btn btn-lg btn-primary " type = "submit" 
               name = "sign up" onClick="parent.location='/hastane/sign.php'">Sign Up</button>
         Click here to clean <a href = "logout.php" tite = "Logout">Session
         
      </div> 
       </div>  </div> 
   </body>
</html>
 
