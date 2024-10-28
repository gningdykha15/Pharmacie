<?php

namespace App\Imports;

use App\Models\Medicament;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class MedicamentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
   
    // Affichage de tout le tableau $row pour vérifier les clés disponibles
    //dd($row);  // À retirer après le débogage
    
    try {
        $dateExcel = trim($row['date_expiration']); // Utilisation du nom de la colonne "date_expiration"

        // Vérification si la cellule est vide
        if (empty($dateExcel)) {
            throw new \Exception("La date d'expiration est manquante pour le médicament : " . $row['nom']);
        }

        // Gestion du format de la date jj/mm/aaaa ou j/m/aaaa
        if (preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $dateExcel)) {
            $dateExpiration = Carbon::createFromFormat('d/m/Y', $dateExcel);
        } 
        // Vérification si c'est un format Excel valide (numérique)
        elseif (is_numeric($dateExcel)) {
            $dateExpiration = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateExcel));
        } else {
            throw new \Exception("La date d'expiration est invalide pour le médicament : " . $row['nom']);
        }

    } catch (\Exception $e) {
        throw new \Exception("Erreur lors de la conversion de la date pour le médicament '" . $row['nom'] . "': " . $e->getMessage());
    }

    return new Medicament([
        'nom' => $row['nom'],
        'code_barre' => $row['code_barre'],
        'description' => $row['description'],
        'dateExpiration' => $dateExpiration,  // Important : date d'expiration doit être valide ici
        'medicament_code' => $row['medicament_code'],
        'notice' => $row['notice'],
        'fabricant' => $row['fabricant'],
    ]);

    \Log::info($medicament);
    return $medicament;

    }
}