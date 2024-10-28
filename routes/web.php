<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentController;



Route::get('/', function () {
    return view('welcome');
});

//Afficher le formulaire
Route::get('/medicaments/create', [MedicamentController::class, 'create'])->name('medicaments.create');

//Traiter les données du formulaire
Route::post('/medicaments', [MedicamentController::class, 'store'])->name('medicaments.store');

// Route pour afficher le formulaire de modification
Route::get('/medicaments/{id}/edit', [MedicamentController::class, 'edit'])->name('medicaments.edit');

// Route pour traiter la mise à jour du médicament
Route::put('/medicaments/{id}', [MedicamentController::class, 'update'])->name('medicaments.update');

// Route pour afficher le formulaire de confirmation de suppression
Route::get('/medicaments/{id}/delete', [MedicamentController::class, 'confirmDelete'])->name('medicaments.confirmDelete');

// Route pour supprimer le médicament
Route::delete('/medicaments/{id}', [MedicamentController::class, 'destroy'])->name('medicaments.destroy');

//Route pour afficher la liste des médicaments
Route::get('/medicaments', [MedicamentController::class, 'index'])->name('medicaments.index');

//Route pour afficher les détails du médicament avec QR code:
Route::get('/medicaments/{id}/qr-code', [MedicamentController::class, 'generateQrCode'])->name('medicaments.qr-code');

Route::get('/medicaments/{id}', [MedicamentController::class, 'show'])->name('medicaments.show');

Route::post('/import-medicaments', [MedicamentController::class, 'import']);

Route::post('/verify-medication', [MedicamentController::class, 'verifyMedication']);
