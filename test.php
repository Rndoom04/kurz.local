<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    
    table td { padding: 8px; }
</style>

<h1>Bubble sort</h1>
<?php
    function bubblesort($_data) {
        $zmena = false;
        $pocet_prvku = count($_data);
        for($i=0; $i<$pocet_prvku; $i++) {
            if (isset($_data[$i]) && isset($_data[$i+1])) {
                $prvek1 = $_data[$i];
                $prvek2 = $_data[$i+1];

                if ($prvek1 < $prvek2) {
                    // Přehoď
                    $_data[$i] = $prvek2;
                    $_data[$i+1] = $prvek1;
                    $zmena = true;
                }
            }
        }
        
        if ($zmena) { $_data = bubblesort($_data); }
        
        return $_data;
    }
    
    
    function vygenerujData() {
        $data = [];
        $max = rand(100, 1000);
        $i = 0;
        
        while($i < $max) {
            $data[$i] = rand(0, 1000);
            $i++;
        }
        
        return $data;
    }
    

    echo "<p>Start</p>";    
    $data = vygenerujData();
    $pocet_prvku = count($data);
    var_dump($pocet_prvku);
    $zmena = true;
    $prvek1 = null;
    $prvek2 = null;
    
    if ($pocet_prvku >= 2) {
        echo "<p>Budeme řadit.</p>";
        $data = bubblesort($data);
    } else {
        echo "<p>Nebudeme řadit, nedostatečný počet prvků k řazení.</p>";
    }
    
    // Vypiš prvky
    $prvku = 0;
    $prvku_na_radek = 15;
    
    echo "<table>";
        for($i=0; $i<$pocet_prvku; $i++) {
            if ($prvku == 0) { echo "<tr>"; }

            echo "<td>".$data[$i]."</td>";
            
            $prvku++;
            if ($prvku == $prvku_na_radek) {
                echo "</tr>";
                $prvku = 0;
            }
        }
    echo "</table>";
    
    // Konec
    echo "<p>Konec</p>";
?>