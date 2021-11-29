<?php
include 'conn.php';
ob_start();
   session_start();
  
 
function validation($username){
                        $username = str_replace('`','\`',$username);
                        $username = str_replace('"','\"',$username);
                        $username = str_replace('\'','',$username);
                        $username = str_replace(" ",'',$username);
                         
                return $username;
                }
         		

            $msg = '';
           
            if (isset($_POST['login']) && !empty($_POST['tc']) && !empty($_POST['password'])) {
				 $sorgu = $conn->query("SELECT * FROM Hasta WHERE HastaTC = '".validation($_POST['tc'])."' ");

 				$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
 				
 				
               if ($_POST['password'] == $cikti['HastaPASSWORD']) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['tc'] = $_POST['tc'];
                  $_SESSION['HastaADI'] = $cikti['HastaADI'];
                  $_SESSION['HastaSOYADI'] = $cikti['HastaSOYADI'];
                  $_SESSION['HastaKANGRUBU'] = $cikti['HastaKANGRUBU'];
                  $_SESSION['HastaIlName'] = $cikti['HastaIlName']; 
  					
                  header("Location: randevu.php");
                  echo 'Basarili';

               }else {
                  $msg = 'Wrong tc or password';
                  echo $msg;
               }
            }
  
?>