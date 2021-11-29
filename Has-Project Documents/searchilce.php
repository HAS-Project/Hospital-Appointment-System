<?php
include('conn.php');

    function validation($username){
                        $username = str_replace('`','\`',$username);
                        $username = str_replace('"','\"',$username);
                        $username = str_replace('\'','',$username);
                        $username = str_replace(" ",'',$username);
                         
                return $username;
                }
    session_start();
/* Database Bağlantısı */
    if ($_REQUEST['termilcesehir']) { 
        $termilcesehir = validation($_REQUEST['termilcesehir']);

        $ilkodu = $conn->query("SELECT IlKODU FROM il WHERE IlADI = '".$termilcesehir."'");
        $ilkodu1 = $ilkodu->fetch(PDO::FETCH_ASSOC);

    if ($_REQUEST['termilce']) { // Bir terim gelip gelmediğini kontrol ediyoruz.
        $term = validation($_REQUEST['termilce']); // Gelen terimi değişkene atıyoruz.
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        $check_query = $conn->query("SELECT IlceADI FROM ilce WHERE IlKODU = ".$ilkodu1['IlKODU']." AND IlceADI LIKE '%".$term."%'");
        $check_row = $check_query->fetch(PDO::FETCH_ASSOC);
        
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        if ($check_row) { // Sorgulama sonucu dolu olursa eğer sonuçları ekrana basıyoruz.
            $query = $conn->query("SELECT IlceADI FROM ilce WHERE IlKODU = ".$ilkodu1['IlKODU']." AND IlceADI LIKE '%".$term."%'");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row['IlceADI'];
                echo '<li class="list-group-item">'.$name.'</li>';
            }
        }else{
            // Eğer eşleşen kayıt yoksa alttaki uyarıyı ekrana basıyoruz.
            echo '<li class="list-group-item">Eşleşen kayıt bulunamadı.</li>';
        }
    }

    }
?>