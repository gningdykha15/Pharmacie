<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\MedicamentImport;   

class MedicamentController extends Controller
{
    protected $medicament;

    public function __construct(){
        $this->medicament = new Medicament(); 
    }

    public function index()
    {
        $medicaments = Medicament::all(); // Récupère tous les médicaments
        return view('medicaments.index', compact('medicaments'));

    }

    public function store(Request $request){
    
        $number = mt_rand(1000000000,9999999999);
        
        if ($this->medicamentCodeExists($number)){
            $number = mt_rand(1000000000,9999999999); 
        }
        $request['medicament_code'] = $number;
        Medicament::create($request->all());
        
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'dateExpiration' => 'required|date',
            'fabricant' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medicament_code' => 'nullable|string',
            'age' => 'required|integer', // Ajout d'un champ pour l'âge
        ]);

        // Création du médicament
    $medicament = Medicament::create($validatedData);

    // Vérifier si le médicament est authentique
    if ($this->isAuthentic($medicament)) {
        // Envoyer la notice et les instructions au client
        $this->sendNoticeAndInstructions($request->input('email'), $medicament, $request->input('age'));
        }
        return redirect()->route('medicaments.index')->with('success', 'Médicament ajouté avec succés!');
        
    }

    private function isAuthentic(Medicament $medicament)
    {
    // Logique pour vérifier l'authenticité (peut-être basée sur le code-barres ou autre)
    return true; // Placeholder, remplacez avec votre logique
    }

    // Méthode pour obtenir les instructions en fonction de l'âge
    private function getInstructionsForAge( $medicament, $age)
    {
    // Logique pour déterminer les instructions basées sur l'âge
    // Exemple simple:
    if ($age < 18) {
        return "Consulter un medicin pour les enfants. ";
    } elseif ($age >= 65) {
        return "Instructions pour les personnes âgées.";
    } else {
        return "Instructions pour les adultes.";
    }
    }
    public function medicamentCodeExists($number){
        return medicament::whereMedicamentCode($number)->exists();
    }

    public function show(string $id)
    {
        $medicament = $this->medicament->find($id);
        $qrCode = new QrCode('http://example.com/medicaments/' . $id);
        $writer = new PngWriter();
        
        // Définir le chemin pour sauvegarder le QR code
        $path = storage_path('app/public/qr-codes/medicament-' . $id . '.png');
        $writer->writeFile($qrCode, $path);

        return view('medicaments.show', compact('medicament', 'path'));
    }  
    
    public function update(Request $request, string $id)
    {
        $medicament = $this->medicament->find($id);
        $medicament->update($request->all());
        return redirect()->route('medicaments.index')->with('success');
        //
    }

    

    public function destroy(string $id)
    {
        $medicament = $this->medicament->find($id); // Rechercher le médicament par ID

    // Vérifier si le médicament existe
    if (!$medicament) {
        // Rediriger avec un message d'erreur si le médicament n'est pas trouvé
        return redirect()->route('medicaments.index')->with('error', 'Médicament non trouvé.');
    }

    // Supprimer le médicament
    $medicament->delete();

    // Rediriger avec un message de succès
    return redirect()->route('medicaments.index')->with('success', 'Médicament supprimé avec succès.');
    }


    public function create()
    {
        return view('medicaments.create');
    }
    

    public function edit($id)
    {
        $medicament = $this->medicament->find($id);
        return view('medicaments.edit', compact('medicament'));
    }

    public function confirmDelete($id)
    {

        $medicament = Medicament::find($id); // Rechercher le médicament par ID

        // Si le médicament n'est pas trouvé, rediriger avec un message d'erreur
        if (!$medicament) {
            return redirect()->route('medicaments.index')->with('error', 'Médicament non trouvé.');
        }

        // Passer le médicament à la vue
        return view('medicaments.delete', compact('medicament'));
    }

    public function generateQrCode($id)
    {
        // Trouver le médicament
        $medicament = Medicament::findOrFail($id);

        // Créer le QR code
        $qrCode = new QrCode('http://example.com/medicaments/' . $medicament->id);
        $writer = new PngWriter();
        
        // Définir le chemin pour sauvegarder le QR code
        $path = storage_path('app/public/qr-codes/medicament-' . $medicament->id . '.png');
        
        //Vérifier et créer le repertoire si nécessaire
        if (!file_exists(storage_path('/app/public/qr-codes'))){
            mkdir(storage_path('/app/public/qr-codes'),0755,true);
        }

        // Retourner le chemin du QR code pour l'affichage ou le téléchargement
        return response()->download($path);

    }

    public function verifyMedication(Request $request)
{
    $barcode = $request->input('barcode');
    $age = $request->input('age');

    $medicament = Medicament::where('codeBarre', $barcode)->first();

    if ($medicament) {
        // Récupération des instructions basées sur l'âge
        $instructions = $this->getInstructionsForAge($medicament, $age);

        return response()->json([
            'authentic' => true,
            'medicament' => $medicament,
            'notice' => $medicament->notice,
            'instructions' => $instructions,
        ]);
    } else {
        return response()->json([
            'authentic' => false,
            'message' => 'Le médicament n\'est pas certifié',
        ]);
    }
}

        public function import(Request $request)
    {
        try {
            Excel::import(new MedicamentImport, $request->file('file')->store('temp'));
            return redirect()->back()->with('success', 'Médicaments importés avec succès');
        } catch (\Exception $e) {
            \Log::error('Erreur d\'importation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }

}
