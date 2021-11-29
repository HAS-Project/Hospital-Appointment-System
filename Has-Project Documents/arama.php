<?php
include('conn.php');
function validation($username){
                        $username = str_replace('`','\`',$username);
                        $username = str_replace('"','\"',$username);
                        $username = str_replace('\'','',$username);
                        
                         
                return $username;
                }
    //SELECT HastaneADI FROM doktorlar WHERE  BolumADI IN (SELECT BolumADI FROM bolum WHERE BolumTAGS LIKE '%".$term."%')
    session_start();
/* Database Bağlantısı */
    if ($_REQUEST['termsikayet'] && $_REQUEST['termwinil'] &&$_REQUEST['termwinilce']) { // Bir terim gelip gelmediğini kontrol ediyoruz.
        $termwinilce = validation($_REQUEST['termwinilce']);
        $termwinil = validation($_REQUEST['termwinil']);
        $term = validation($_REQUEST['termsikayet']); // Gelen terimi değişkene atıyoruz.
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        $check_query = $conn->query("SELECT * FROM doktorlar WHERE HastaneADI IN (SELECT HastaneADI FROM hastaneler WHERE HastaneIL ='".$termwinil."' AND HastaneILCE ='".$termwinilce."') AND BolumADI IN (SELECT BolumADI FROM bolum WHERE BolumTAGS LIKE '%".$term."%')");

        $check_row = $check_query->fetch(PDO::FETCH_ASSOC);
        
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        if ($check_row) { // Sorgulama sonucu dolu olursa eğer sonuçları ekrana basıyoruz.
            $query = $conn->query("SELECT * FROM doktorlar WHERE HastaneADI IN (SELECT HastaneADI FROM hastaneler WHERE HastaneIL ='".$termwinil."' AND HastaneILCE ='".$termwinilce."') AND BolumADI IN (SELECT BolumADI FROM bolum WHERE BolumTAGS LIKE '%".$term."%')");

            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $BolumADI = $row['BolumADI'];
                $DoktorADI = $row['DoktorADI'];
                $DoktorSOYADI = $row['DoktorSOYADI'];
                $HastaneADI = $row['HastaneADI'];
                echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">';
                echo '<div class="d-flex w-100 justify-content-between">';
                echo '<h5 class="mb-1">'.$BolumADI.'. </h5>';
                echo '</div>';
                echo '<p class="mb-1">'.$DoktorADI.' '.$DoktorSOYADI.'. </p>';
                echo '<small>'.$HastaneADI.'</small>';
                echo '</a>';
            }
        }else{
            // Eğer eşleşen kayıt yoksa alttaki uyarıyı ekrana basıyoruz.
            echo '<li class="list-group-item">Eşleşen kayıt bulunamadı.</li>';
        }
    }
?>