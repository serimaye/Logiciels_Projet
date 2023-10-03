<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logiciel;
use App\Models\Category;
use Illuminate\Http\Response;

class LogicielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logiciels = Logiciel::all();
        return view('admin.logiciels.index',compact('logiciels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.logiciels.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!empty(request('add'))) {

            $logiciel = new Logiciel;
            $logiciel->name = $request->name;
            $logiciel->image = $request->image;
            $logiciel->version = $request->version;
            $logiciel->description = $request->description;
            $logiciel->category_id = $request->categorie;
            $logiciel->save();

            return $this->index();
        }


        //$category->logiciels()->create([
         //   'name'=>$request->name,
          //  'image'=>$request->image,
            //'version'=>$request->version,
           // 'description'=>$request->description,
        //]);



    }

    public function suppression($id)
    {
        $logiciel = Logiciel::find($id);

        if (!$logiciel) {
            return redirect()->back()->with('error', 'Logiciel non trouvé.');
        }

        $logiciel->delete();

        return $this->index()->with('success', 'Logiciel supprimé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function modifier(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name'=> 'required',
            'category_id'=> 'required',
            'image'=>'required',
            'version'=>'required',
            'description'=>'required',
        ]);


        $logiciel = Logiciel::findOrFail($id);

        if (!$logiciel) {
            return redirect()->back()->with('error', 'logiciel non trouvé.');
        }

        // Mettre à jour les données du logiciel
        $logiciel->update([

            'nom' => $validatedData['nom'],
            'categorie_id' => $validatedData['categorie_id'],
            'image' => $validatedData['image'],
            'version' => $validatedData['version'],
            'description' => $validatedData['description'],


        ]);


        return $this->index()->with('success', 'Logiciel mis à jour avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function search(Request $request)
    {
        $searchTerm = $request->search;

        // Recherche des logiciels en fonction du terme de recherche
        $logiciels = Logiciel::where('nom', 'like', '%'.$searchTerm.'%')->get();

        return view('logiciels.search', compact('logiciels', 'searchTerm'));
    }
}
