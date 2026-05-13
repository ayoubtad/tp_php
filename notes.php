<?php

function calculerMoyenne($notes)
{

    if (count($notes) === 0) {
        return 0;
    }

    return round(array_sum($notes) / count($notes), 2);
}

function determinerMention($moyenne)
{
    if ($moyenne >= 16) {
        return "Très Bien";
    } elseif ($moyenne >= 14) {
        return "Bien";
    } elseif ($moyenne >= 12) {
        return "Assez Bien";
    } elseif ($moyenne >= 10) {
        return "Passable";
    } else {
        return "Insuffisant";
    }
}
function estAdmis($moyenne, $seuil)
{
    if ($moyenne >= $seuil) {
        return true;
    } else {
        return false;
    }
}
function formaterNomComplet($prenom, $nom)
{
    return ucfirst(strtolower($prenom)) . " " . strtoupper($nom) . "";
}
function genererReleve($etudiant, $matiere, $seuil)
{
    $longueure_ligne = 40;
    $longueure_intitule = 14;
    $relevet = "";

    $nom_complet = formaterNomComplet($etudiant['prenom'], $etudiant['nom']);

    $relevet .= str_repeat("=", $longueure_ligne) . "\n";
    $relevet .= "Releve de notes -- " . $nom_complet . "\n";
    $relevet .= str_repeat("=", $longueure_ligne) . "\n";

    foreach ($matiere as $nom_matiere => $note_obtenue) {
        $nom_matiere = ucfirst(strtolower($nom_matiere));
        $relevet .= str_pad($nom_matiere, $longueure_intitule) . ": " . $note_obtenue . "/20\n";
    }

    $moyenne = calculerMoyenne(array_values($matiere));
    $mention = determinerMention($moyenne);
    $resultat = estAdmis($moyenne, $seuil) ? "ADMIS" : "NON ADMIS";

    $relevet .= str_repeat("-", $longueure_ligne) . "\n";
    $relevet .= str_pad("Moyenne", $longueure_intitule) . ": " . number_format($moyenne, 2) . "/20\n";
    $relevet .= str_pad("Mention", $longueure_intitule) . ": " . $mention . "\n";
    $relevet .= str_pad("Resultat", $longueure_intitule) . ": " . $resultat . "\n";
    $relevet .= str_repeat("=", $longueure_ligne) . "\n";

    return $relevet;


}

/**
 * $etudiant = array (
 * array(
 * "prenom" => "Yassine",
 * "nom" => "Elbouari",
 * "notes" => [14,12,9,15,11]
 * ),
 * ....
 * )
 * $seuil : float
 * 
 * 
 * retourner:
 * array(
 * "moyenne_promo" : float,
 * "meilleur       : str,
 * "moin_bon"      : str,
 * "nb_admis"      : int,
 * "nb_ajournres"  : int,
 * "taux_reussite" :float
 *  )
 */

function calculerStatistiquesPromotion($etudiants, $seuil)
{
    $taille = count($etudiants);
    $statistiques = array(

    );
    //les initialisation
    $moyenne_etd_0 = calculerMoyenne($etudiants[0]['notes']);
    $somme_moyenne = $moyenne_etd_0;
    $eleve_max = $etudiants[0];
    $nom_meilleur = $etudiants[0];
    $nb_admis = estAdmis($moyenne_etd_0, $seuil) ? 1 : 0;

    for ($i = 1; $i < $taille; $i++) {
        //la somme des moyennes

        $moyenne_etudiant_courrant = calculerMoyenne($etudiants[$i]["notes"]);
        $somme_moyenne += $moyenne_etudiant_courrant;

        //meilleur élève
        if (calculerMoyenne($eleve_max['notes']) < $moyenne_etudiant_courrant) {
            $eleve_max = $etudiants[$i];
        }

        //élève le moin bon
        if (calculerMoyenne($eleve_max['notes']) > $moyenne_etudiant_courrant) {
            $eleve_min = $etudiants[$i];
        }

        // nombre admis
        $nb_admis += estAdmis($moyenne_etudiant_courrant, $seuil) ? 1 : 0;

    }
    // statistiques de la promotion
    return array(
        "moyenne_promo" => round($somme_moyenne / $taille, 1),
        "meilleur" => formaterNomComplet($eleve_max["nom"], $eleve_max['prenom']),
        "moin_bon" => formaterNomComplet($eleve_min["nom"], $eleve_min['prenom']),
        "nb_admis" => $nb_admis,
        "nb_ajournres" => $taille - $nb_admis,
        "taux_reussite" => round($nb_admis / $taille * 100, 1)
    );
}