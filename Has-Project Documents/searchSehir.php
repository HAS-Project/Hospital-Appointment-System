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
    if ($_REQUEST['termsehir']) { // Bir terim gelip gelmediğini kontrol ediyoruz.
        $term = validation($_REQUEST['termsehir']); // Gelen terimi değişkene atıyoruz.
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        $check_query = $conn->query("SELECT * FROM Il WHERE IlADI LIKE '%".$term."%'");
        $check_row = $check_query->fetch(PDO::FETCH_ASSOC);
        
        /* Gelen terim ile eşleşen kayıt olup olmadığını sorguluyoruz. */
        if ($check_row) { // Sorgulama sonucu dolu olursa eğer sonuçları ekrana basıyoruz.
            $query = $conn->query("SELECT * FROM Il WHERE IlADI LIKE '%".$term."%'");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row['IlADI'];
                echo '<li class="list-group-item">'.$name.'</li>';
            }
        }else{
            // Eğer eşleşen kayıt yoksa alttaki uyarıyı ekrana basıyoruz.
            echo '<li class="list-group-item">Eşleşen kayıt bulunamadı.</li>';
        }
    }



?>