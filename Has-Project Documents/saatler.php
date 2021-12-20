<?php
include('conn.php');
    session_start();
    if ($_REQUEST['randevudates'] && $_REQUEST['randevuBolumAD'] ){
        $randevudates = $_REQUEST['randevudates'];
        $randevuBolumAD = $_REQUEST['randevuBolumAD'];

        $check_query = $conn->query("SELECT * FROM saat WHERE Saat NOT IN (SELECT RandevuSaat FROM randevu WHERE RandevuBolumADI LIKE '".$randevuBolumAD."' AND RandevuTarih LIKE '".$randevudates."') ");
        $check_row = $check_query->fetch(PDO::FETCH_ASSOC);
        
       
        if ($check_row) { 
            $query = $conn->query("SELECT * FROM saat WHERE Saat NOT IN (SELECT RandevuSaat FROM randevu WHERE RandevuBolumADI LIKE '".$randevuBolumAD."' AND RandevuTarih LIKE '".$randevudates."') ");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row['Saat'];
                echo '<button class = "btn btn-lg btn-primary" type="submit" name="saatr" value="'.$name.'">'.$name.'</button> &nbsp';
            }
        }else{
            // Eğer eşleşen kayıt yoksa alttaki uyarıyı ekrana yansıtıyoruz.
            
        }
    
    
    //''
        
    }
?>
