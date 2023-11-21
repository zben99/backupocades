<?php

namespace App\Http\Controllers;

use App\Repositories\TypeDocumentRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TypeDocumentController extends Controller
{
    protected $typeDocument;

    public function __construct(TypeDocumentRepositoryInterface $typeDocument)
    {
        $this->middleware('auth');
        $this->typeDocument = $typeDocument;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parametres.typedocuments.index', [
            'types' => $this->typeDocument->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required',
            ],
        );

        $this->typeDocument->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le type de Document a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'libelle' => 'required',
            ],
        );


        $this->typeDocument->update($request->code, $request->all());
        Alert::success('Opération Réussie', 'Le type de Document a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->typeDocument->delete($request->code);
        Alert::success('Suppression', 'Le type de Document a été supprimé avec succès!');

        return redirect()->route('type-documents.index');
    }
}
