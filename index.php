<?php
require_once 'notes.php'; // ta bibloitheque de fonctions
$etudiants = array(
    array("prenom" => "Yassine", "nom" => "Elbouari", "notes" => array(14, 12, 9, 15, 11)),
    array("prenom" => "Salma", "nom" => "Chraibi", "notes" => array(8, 6, 5, 7, 9)),
    array("prenom" => "Mehdi", "nom" => "Tazi", "notes" => array(17, 18, 15, 16, 19)),
    array("prenom" => "Nour", "nom" => "Idrissi", "notes" => array(10, 10, 10, 10, 10)),
    array("prenom" => "Hamza", "nom" => "Benkiran", "notes" => array(12, 9, 14, 8, 11)),
    array("prenom" => "Lina", "nom" => "Fassi", "notes" => array(6, 4, 7, 3, 5)),
    array("prenom" => "Omar", "nom" => "Sekkat", "notes" => array(13, 15, 12, 14, 16)),
);
$matiers = array("Maths", "Physique", "Informatique", "Anglais", "Français");
$seuil_admission = 10;
$statistiques = calculerStatistiquesPromotion($etudiants, $seuil_admission);
foreach ($statistiques as $k => $v) {
    echo "$k : $v \n";
}
