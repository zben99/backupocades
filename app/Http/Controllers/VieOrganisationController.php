<?php

namespace App\Http\Controllers;

use App\Repositories\VieOrganisationRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\TypeDocumentRepositoryInterface;

class VieOrganisationController extends Controller
{
    protected $type;
    protected $vieOrganisation;

    public function __construct(VieOrganisationRepositoryInterface $vieOrganisation,TypeDocumentRepositoryInterface $type)
    {
        $this->middleware('auth');
        $this->vieOrganisation = $vieOrganisation;
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('vieOrganisations.index', [
            'documents' => $this->vieOrganisation->all(),
            'types' => $this->type->all(),
        ]);
    }

    public function show($code)
    {

        return view('vieOrganisations.show', [
            'document' => $this->vieOrganisation->get($code),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nom'=>  'required',
                'auteur' => 'required',
                'nb'=> '',
                'resume'=> 'required',
                //'date_publication'=> 'required',
                'type_document_id'=> 'required'
            ],
        );

        $this->validate($request, [
            'logo.*' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $input = $request->all();
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $date = date("Y_m_d_H_i_s");
            $name = $date . "_" . $file->getClientOriginalName();
            $file->move(public_path().'/logo/', $name);
            $input["logo"] = $name;
        }else{
            $input["logo"] = "" ;
        }
        $input['date_publication'] = date("Y-m-d");
        $this->vieOrganisation->add($input);
        Alert::success('Enregistrement Réussi', 'Le Document a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'nom'=>  'required',
                'auteur' => 'required',
                'nb'=> '',
                'resume'=> 'required',
                //'date_publication'=> 'required',
                'type_document_id'=> 'required'
            ],
        );
        $doc = $this->vieOrganisation->get($request->code);
        $this->validate($request, [
            'logo.*' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $input = $request->all();
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $date = date("Y_m_d_H_i_s");
            $name = $date . "_" . $file->getClientOriginalName();
            $file->move(public_path().'/logo/', $name);
            $input["logo"] = $name;
        }else{
            $input["logo"] = $doc->logo ;
        }
        $input["date_publication"] = $doc->date_publication;
        $this->vieOrganisation->update($request->code, $input);
        Alert::success('Opération Réussie', 'Le Document a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vieOrganisation  $vieOrganisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->vieOrganisation->delete($request->code);
        Alert::success('Suppression', 'Le Document a été supprimé avec succès!');
        return redirect()->route('documents.index');
    }
}
