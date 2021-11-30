<?php
include 'conn.php';
ob_start();
   session_start();
 

  
?>

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
	 <script type="text/javascript">

    $(document).ready(function(){
        $('.search-box input[type="search"]').on("keyup input", function(){
            /* Input Box'da değişiklik olursa aşağıdaki durumu çalıştırıyoruz. */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".liveresult");
            if(inputVal.length){
                $.get('searchSehir.php', {termsehir: inputVal}).done(function(data){
                    /* Gelen sonucu ekrana yazdırıyoruz. */
                    resultDropdown.html(data);
                });
            }else{
                resultDropdown.empty();
            }
        });
        /* Sonuç listesinden üzerinde tıklanıp bir öğe seçilirse input box'a yazdırıyoruz. */
        $(document).on("click", ".liveresult li", function(){
            $(this).parents(".search-box").find('input[type="search"]').val($(this).text());
            $(this).parent(".liveresult").empty();
        });
    });

var max_chars = 11;

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
<?php
         		function validation($username){
                        $username = str_replace('`','\`',$username);
                        $username = str_replace('"','\"',$username);
                        $username = str_replace('\'','',$username);
                        $username = str_replace(" ",'',$username);
                         
                return $username;
                }
         		

            $msg = '';
           
            if (isset($_POST['SignIn']) && !empty($_POST['tc']) && !empty($_POST['adiniz']) && !empty($_POST['soyadiniz']) && !empty($_POST['password']) && !empty($_POST['dogumtarihiniz']) && !empty($_POST['kangrubunuz']) && !empty($_POST['cinsiyet'])) {
				 

				 if(strlen($_POST['tc']) == 11){
				 	try{
				 	$sorgu = $conn->exec("INSERT INTO hasta (HastaTC, HastaADI, HastaSOYADI, HastaPASSWORD,HastaIlName,HastaDOGUMTARIHI, HastaKANGRUBU, HastaCINSIYETI) VALUES(".validation($_POST['tc'])." ,'".validation($_POST['adiniz'])."', '".validation($_POST['soyadiniz'])."','".validation($_POST['password'])."' , '".validation($_POST['il'])."' , '".validation($_POST['dogumtarihiniz'])."','".validation($_POST['kangrubunuz'])."' , '".validation($_POST['cinsiyet'])."')");

				 	echo "Uye Kayit islemi basarili...";
				 	header('Refresh: 2; URL = index.php');

				 	}catch(Exception $ex){

				 		if (strpos($ex,"Duplicate") !== false) 
        					echo '<div class = "container">
       <div class="row">
       	  <div class="col-12 search-box"><p>Bu TC ile Kayit Mevcut Sifrenizi Hatirlamiyorsaniz Tiklayiniz...</p> </div> </div>';

   					 	
				 	}
				 }else{
				 	
				 }

 				
 				
 				
               //if ($_POST['password'] == $cikti['HastaPASSWORD']) {
               //   $_SESSION['valid'] = true;
               //   $_SESSION['timeout'] = time();
               //   $_SESSION['username'] = $_POST['username'];
               //   
              //    header("Location: randevu.php");
              // }else {
              //    $msg = 'Wrong username or password';
              // }
            }
         ?>
	
      
<div class = "container">
       <div class="row">
       	  <div class="col-12 search-box">
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>

            <input type = "number" class = "form-control"  
               id = "tc" name = "tc"  placeholder = "tc" maxlength="11" size="11"
               required autofocus></br>

               <input type = "text" class = "form-control" 
               name = "adiniz" placeholder = "Adiniz" 
               required autofocus></br>

               <input type = "text" class = "form-control" 
               name = "soyadiniz" placeholder = "Soyadiniz" 
               required autofocus></br>

               <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required></br>

               
               <input type = "search" class = "form-control"
               name = "il" placeholder = "il" required>
               <ul class="list-group liveresult"></ul></br>
               

              	<input type = "date" class = "form-control" 
               name = "dogumtarihiniz" 
               required autofocus></br>

               <input list="kangrubunuz" class = "form-control" 
               name = "kangrubunuz" placeholder = "Kan Grubunuz" 
               required autofocus>
               <datalist id="kangrubunuz">
  					<option value="A rh +">
  					<option value="A rh -">
  					<option value="AB rh +">
  					<option value="AB rh -">
  					<option value="B rh +">	
  					<option value="B rh -">
  					<option value="0 rh +">
  					<option value="0 rh -">					
			</datalist>
           </br>

               <input list="cinsiyet" class = "form-control" 
               name = "cinsiyet" placeholder = "Cinsiyet" 
               required autofocus>
               <datalist id="cinsiyet">
  					<option value="Erkek">
  					<option value="Kadın">
  					<option value="Belirtmek istemiyorum">		
			</datalist>	
           </br>
               
<center>

              <button style="background-color:light blue;color:white;width:20%;" class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "SignIn">Sign In</button>
         </form>

			
         Click here to clean <a href = "logout.php" tite = "Logout">Session 
		 </center>
          </div>
        </div>
      </div> 
</body>
</html>

