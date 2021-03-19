<?php
require_once './abkapcsolat.php';
$bemenet = $_GET['bemenet'];
$kapcsolat = new ABKapcsolat();
$sql = "select * from varos where nev like '".$bemenet."%'";
$eredmeny = $kapcsolat->sqlLekerdez($sql);
if (!empty($eredmeny)) {
    $i = 0;
    $valasz = "";
    $valaszSelect = "<select name='valaszSelect' id='valaszSelect'>";
    $valaszTable = "<table id='valaszTable'>";
    $valaszTable .= "<tr><td>ID</td><td>Név</td><td>Megye</td><td>Járás</td>"
            ."<td>Kistérség</td><td>Népesség</td><td>Terület</td>"
            ."<td>Irányítószám</td><td>Mióta város</td><td>Típus</td>"
            ."<td></td><td></td></tr>";
    if (1 < count($eredmeny)) {
        while ($i < count($eredmeny)) {
            $sor = $eredmeny[$i];
            $ID = $sor['ID'];
            $nev = $sor['nev'];
            $megye = $sor['megye'];
            $jaras = $sor['jaras'];
            $kisterseg = $sor['kisterseg'];
            $nepesseg = $sor['nepesseg'];
            $terulet = $sor['terulet'];
            $iranyitoszam = $sor['iranyitoszam'];
            $miota_varos = $sor['miota_varos'];
            $tipus = $sor['tipus'];
            $valaszSelect.="<option value='".$ID."'>".$nev."</option>";
            $valaszTable.="<tr><td>".$ID."</td><td>".$nev."</td>"
                    ."<td>".$megye."</td><td>".$jaras."</td>"
                    ."<td>".$kisterseg."</td><td>".$nepesseg."</td>"
                    ."<td>".$terulet."</td><td>".$iranyitoszam."</td>"
                    ."<td>".$miota_varos."</td><td>".$tipus."</td>"
                    ."<td><button id='btnTorol'>Töröl</button></td>"
                    ."<td><button id='btnModosit'>Módosít</button></td></tr>";
            $i++;
        }
    } else if (count($eredmeny) == 1) {
        $sor = $eredmeny[0];
        $ID = $sor['ID'];
        $nev = $sor['nev'];
        $megye = $sor['megye'];
        $jaras = $sor['jaras'];
        $kisterseg = $sor['kisterseg'];
        $nepesseg = $sor['nepesseg'];
        $terulet = $sor['terulet'];
        $iranyitoszam = $sor['iranyitoszam'];
        $miota_varos = $sor['miota_varos'];
        $tipus = $sor['tipus'];
        $valaszSelect.="<option value='".$ID."'>".$nev."</option>";
        $valaszTable.="<tr><td>".$ID."</td><td>".$nev."</td>"
                ."<td>".$megye."</td><td>".$jaras."</td>"
                ."<td>".$kisterseg."</td><td>".$nepesseg."</td>"
                ."<td>".$terulet."</td><td>".$iranyitoszam."</td>"
                ."<td>".$miota_varos."</td><td>".$tipus."</td>"
                ."<td><button id='btnTorol'>Töröl</button></td>"
                ."<td><button id='btnModosit'>Módosít</button></td></tr>";
    }
    $valaszSelect .= "</select>";
    $valaszTable .= "</table>";
    $valasz = "<section id='valasz'>".$valaszSelect."<br><br>".$valaszTable."</section>";
} else {
    $valasz = "";
}
echo $valasz;