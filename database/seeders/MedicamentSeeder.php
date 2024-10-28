<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicament::create([
            'nom' => 'Paracétamol',
            'codeBarre' => '1234567890123',
            'medicament_code' => 'MED001',
            'description' => 'Un analgésique et antipyrétique courant.',
            'notice' => 'À prendre avec de l\'eau, jusqu\'à 3 fois par jour.',
            'traitement' => 'Adultes : 500 mg, Enfants : 250 mg',
            'dateExpiration' => '2025-12-31',
        ]);

        Medicament::create([
            'nom' => 'Ibuprofène',
            'codeBarre' => '2345678901234',
            'medicament_code' => 'MED002',
            'description' => 'Utilisé pour réduire la fièvre et traiter la douleur ou l\'inflammation.',
            'notice' => 'À prendre avec de la nourriture pour éviter les maux d\'estomac.',
            'traitement' => 'Adultes : 400 mg, Enfants : 200 mg',
            'dateExpiration' => '2024-06-30',
        ]);

    }
}
