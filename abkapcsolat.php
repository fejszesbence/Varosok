<?php

class ABKapcsolat {
    
    private $szervernev;
    private $felhasznalonev;
    private $jelszo;
    private $adatbazisnev;
    
    public function __construct() {
        $this->szervernev = "tanulo10.szf1a.oktatas.szamalk-szalezi.hu";
        $this->felhasznalonev = "c1_tanulo10szf1a";
        $this->jelszo = "_tanulo10szf1a";
        $this->adatbazisnev = "c1ABtanulo10szf1a";
    }

    protected function csatlakozas() {
        $kapcsolat = new mysqli($this->szervernev, $this->felhasznalonev, $this->jelszo, $this->adatbazisnev);
        $kapcsolat->query("SET NAMES UTF8");
        $kapcsolat->query("SET CHARACTER SET UTF8");
        $kapcsolat->query("SET COLLATION_CONNECTION = 'UTF8_HUNGARY_CI'");
        return $kapcsolat;
    }
    
    public function sqlLekerdez($sql) {
        if (strtolower(substr($sql, 0, 6)) === "select") {
            $eredmeny = $this->csatlakozas()->query($sql);
            if ($eredmeny) {
                $sorokDB = $eredmeny->num_rows;
                while ($sor = $eredmeny->fetch_assoc()) {
                    if ($sorokDB === 1 && count($sor) === 1) {
                        $kulcs = key($sor);
                        $ertek = $sor[$kulcs];
                        return $ertek;
                    }
                    else {
                        $adatok[] = $sor;
                    }
                }
                if (isset($adatok)) {
                    return $adatok;
                }
            }
        }
        else {
            $this->csatlakozas()->query($sql);
            return "Lekérdezés sikeresen végrehajtva: '".$sql."'";
        }
    }
    
    public function bezar() {
        $this->csatlakozas()->close();
    }
    
}

