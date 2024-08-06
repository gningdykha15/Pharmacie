<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;

class MedicamentController extends Controller
{
    protected $medicament;

    public function __construct(){
        $this->medicament = new Medicament(); 
    }

    public function index()
    {
        return $this->medicament->all();

    }

    public function store(Request $request)
    {
        return $this->medicament->create($request->all());

        
    }

    public function show(string $id)
    {
        return $medicament = $this->medicament->find($id);
    }    
    
    public function update(Request $request, string $id)
    {
        $medicament = $this->medicament->find($id);
        $medicament->update($request->all());
        return $medicament;
        //
    }

    public function destroy(string $id)
    {
        $medicament = $this->medicament->find($id);
        return $medicament->delete();
        //
    }
}
