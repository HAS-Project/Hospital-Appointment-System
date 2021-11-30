<?php
include 'login.php'; //SELECT * FROM randevu WHERE RandevuTC =30103851501 AND RandevuTarih =2021-09-11 AND RandevuBolumADI =Beyin ve Sinir Cerrahisi
    if(isset($_POST['saatr'])){
        $valuesaatr = $_POST['saatr'];
        $sehiril = $_POST['sehiril'];
        $ilceilce = $_POST['ilceilce'];
        $dert = $_POST['dert'];
        $dates = $_POST['dates'];
        $array = explode(".",$dert);
        $strar =$array[1];
        $arrayname = explode(" ",$strar);
        $check_query = $conn->query("SELECT COUNT(*) FROM randevu WHERE RandevuTC = '".$_SESSION['tc']."' AND RandevuTarih = '".$dates."' AND RandevuBolumADI ='".$array[0]."'");

        $check_row = $check_query->fetchColumn();
        
       if($check_row>0){
		echo "<p>Bir tane randevunuz bulunuyor onu iptal ettikten sonra tekrar randevu alabilirsiniz</p>"; 
       }else{
	try{
       	
		$sorgu = $conn->exec('INSERT INTO `randevu`(`RandevuSaat`, `RandevuTarih`, `RandevuTC`, `RandevuIlADI`, `RandevuIlceADI`, `RandevuHastaneADI`, `RandevuBolumADI`, `RandevuDoktorNAME`, `RandevuDoktorSURNAME`, `RandevuCONTROL`) VALUES ("'.$valuesaatr.'","'.$dates.'","'.$_SESSION['tc'].'","'.$sehiril.'","'.$ilceilce.'","'.$array[2].'","'.$array[0].'","'.$arrayname[1].'","'.$arrayname[2].'","'.$valuesaatr.$dates.$_SESSION['tc'].$array[0].'")');
             echo "<p>Randevunuz eklenmistir</p>";
           
            }catch(Exception $e){
             
            }
       }

		     
        
        	 
        
        
    }

    if(isset($_POST['delrand'])){
    	$del = $_POST['delrand'];
    	$sorgu = $conn -> exec("DELETE FROM `randevu` WHERE RandevuCONTROL ='".$del."'");
    }
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

function validation(username){
         				username = username.replace('`','\`');
         				username = username.replace('"','\"');
         				username = username.replace('\'','\'');
         				username = username.replace(" ",'');
         				 
         		return $username;
         		}

$(document).on("click","#sehir ",function(){

				$(this).parents(".search-box").find('input[id="sehir"]').val("");
				$(this).parents(".search-box").find('input[id="ilce"]').val("");
				$(this).parents(".search-box").find('textarea[id="sikayet"]').val("");
				 $('.saatbuttons').empty();
				 
		});
		$(document).on("click","#ilce ",function(){

				$(this).parents(".search-box").find('input[id="ilce"]').val("");
				$(this).parents(".search-box").find('textarea[id="randevudate"]').val("");
				$('.saatbuttons').empty();
					

		});
		$(document).on("click","#sikayet ",function(){

				$(this).parents(".search-box").find('textarea[id="sikayet"]').val("");
				$('.saatbuttons').empty();
				
				

		});
    $(document).ready(function(){
       


/* =======================================================================================================================*/
		

        $('.search-box input[id="sehir"]').on("keyup input", function(){

            /* Input Box'da değişiklik olursa aşağıdaki durumu çalıştırıyoruz. */
            window.sehir = $(this).val();
            var resultDropdown = $(this).siblings(".sehirliveresult");
            if(sehir.length >0 ){
                $.get('searchSehir.php', {termsehir: sehir}).done(function(data){
                    /* Gelen sonucu ekrana yazdırıyoruz. */
                    resultDropdown.html(data);

                });
            }else{
                resultDropdown.empty();
            }
        });

       
        /* Sonuç listesinden üzerinde tıklanıp bir öğe seçilirse input box'a yazdırıyoruz. */
        $(document).on("click", ".sehirliveresult li", function(){
            $(this).parents(".search-box").find('input[id="sehir"]').val($(this).text());
             $(this).parents(".search-box").find('input[id="ilce"]').val("");
             $(this).parents(".search-box").find('textarea[id="sikayet"]').val("");
            $(this).parent(".sehirliveresult").empty();
            window.il = $(this).text();
        });

        
        /* =======================================================================================================================*/
        $('.search-box input[id="ilce"]').on("keyup input", function(){
        	
            /* Input Box'da değişiklik olursa aşağıdaki durumu çalıştırıyoruz. */
            window.ilces = $(this).val();
            var resultDropdown = $(this).siblings(".ilceliveresult");
            if(ilces.length > 0  && window.sehir.length > 0){
                $.get('searchilce.php', {termilce: ilces,termilcesehir: window.il}).done(function(data){
                    /* Gelen sonucu ekrana yazdırıyoruz. */
                    resultDropdown.html(data);

                });
            }else{
                resultDropdown.empty();
            }
        });
        /* Sonuç listesinden üzerinde tıklanıp bir öğe seçilirse input box'a yazdırıyoruz. */
        $(document).on("click", ".ilceliveresult li", function(){

            $(this).parents(".search-box").find('input[id="ilce"]').val($(this).text());
            $(this).parents(".search-box").find('textarea[id="sikayet"]').val("");
            $(this).parent(".ilceliveresult").empty();
            window.ilce = $(this).text();
        });

         /* =======================================================================================================================*/
        $('.search-box textarea[id="sikayet"]').on("keyup input", function(){
            /* Input Box'da değişiklik olursa aşağıdaki durumu çalıştırıyoruz. */
            
            window.sikayet = $(this).val();
            
            var resultDropdown = $(this).siblings(".sikayetliveresult");
            if(sikayet.length > 0 && window.ilces.length > 0 && window.sehir.length > 0){
                $.get('arama.php', {termsikayet: sikayet , termwinil :window.il , termwinilce:window.ilce}).done(function(data){
                    /* Gelen sonucu ekrana yazdırıyoruz. */
                    resultDropdown.html(data);
                });
            }else{
                resultDropdown.empty();
            }
        });
        /* Sonuç listesinden üzerinde tıklanıp bir öğe seçilirse input box'a yazdırıyoruz. */
        $(document).on("click", ".sikayetliveresult a", function(){
        	
        	
            $(this).parents(".search-box").find('textarea[id="sikayet"]').val($(this).text().replace(".",".\n").replace(".",".\n"));
            $(this).parent(".sikayetliveresult").empty();
            window.arraybolumna = $(this).text().replace(".",".\n").replace(".",".\n").split(".");

            var inputdate = $('.search-box input[id="randevudate"]').val();
           var resultDropdown = $('.search-box input[id="randevudate"]').siblings(".saatbuttons");
            if(inputdate.length>0){
            	
                $.get('saatler.php', {randevudates: inputdate,randevuBolumAD: arraybolumna[0]}).done(function(data){
                    /* Gelen sonucu ekrana yazdırıyoruz. */
                    resultDropdown.html(data);
                    
                });
            }else{
                resultDropdown.empty();
                
            }
        });

        




    });




    </script>
    <title>Php & Mysql ile Canlı Arama (Live Search)</title>
  </head>
<body>
<div class="container">
        <div class="row">
          <div class="col-12 search-box">
          	<h2>Hasta Bilgileri</h2></br>
          	<?php


try{
if(isset($_SESSION['tc'])){
echo '<p>'.$_SESSION['tc'].'</p>';
echo '<p>'.$_SESSION['HastaADI'].'</p>';
echo '<p>'.$_SESSION['HastaSOYADI'].'</p>';
echo '<p>'.$_SESSION['HastaKANGRUBU'].'</p>';
echo '<p>'.$_SESSION['HastaIlName'].'</p>';



?>			 <h4>Randevu Bilgilerim</h4></br>
			<?php

		$query = $conn->query("SELECT * FROM randevu WHERE RandevuTC = '".$_SESSION['tc']."'");

        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                 echo '<form method="post" action ='.htmlspecialchars($_SERVER['PHP_SELF']).'>';
                echo '<p>'.$row['RandevuSaat'].'</p>';
                echo '<p>'.$row['RandevuTarih'].'</p>';
                echo '<p>'.$row['RandevuHastaneADI'].'</p>';
                echo '<p>'.$row['RandevuBolumADI'].'</p>';
                echo '<p>'.$row['RandevuDoktorNAME'].' '.$row['RandevuDoktorSURNAME'].'</p>';
                echo '<button class = "btn btn-lg btn-primary" type="submit" value="'.$row['RandevuCONTROL'].'" name="delrand"> Sil Randevuyu </button>';
                echo '</form>';
            }


			?>
            <h4>Bolum Arama</h4></br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" name="randevuadd" method="post">
            <input type="text" id="sehir" name="sehiril" class="form-control" autocomplete="off" placeholder="Il Gir..." />
            <ul class="list-group sehirliveresult"></ul></br>
            <input type="text" id="ilce" name="ilceilce" class="form-control" autocomplete="off" placeholder="Ilce Gir..." />
        	<ul class="list-group ilceliveresult"></ul></br>
            <textarea type="text" style="height: 90px" id="sikayet" name="dert" class="form-control" autocomplete="off" placeholder="Derdini Ara..."></textarea>
            <ul class="list-group sikayetliveresult">
  			</ul></br>

  			<div class="row" >
                      
                        <div class="col-md-6" style="width: 500px">
<input type="date" name="dates" value="<?php echo date('Y-m-d'); ?>" name="date" id="randevudate" class="form-control" ><br>
<div class="saatbuttons">
<a href="index.php"> çıkış yap </a>

</div>
                     </div>
                    </div>
                </form>
    </div>
        </div>
      </div>

      <?php
}
}catch(Exception $ex){
	echo $ex -> getmessage();
}
      ?>
</body>
</html>
