<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Exports\ProgramsMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\ProgramRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramController extends Controller
{
    protected $program;

    public function __construct(ProgramRepositoryInterface $program)
    {
        $this->middleware('auth');

        $this->program = $program;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.index', [
            'programs' => $this->program->all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'description' => '',
            ],
        );

        $this->program->add($request->all());
        Alert::success('Enregistrement Réussi', 'Le programme a été ajouté avec succès!');
        return response()->json(['success' => 'true']);
    }

    public function rapportImprimer(Request $request)
    {
        $request->validate(
            [
                'debut' => 'required',
                'fin' => 'required',
            ],
        );
        return Excel::download(new ProgramsMultiSheetExport($request->debut,$request->fin), 'Rapport.xlsx');

        $dateD = date($request->all()['debut']);
        $dateF = date($request->all()['fin']);
        Alert::success('Export Réussi', 'Le rapport a été génerer avec succès! Verifier votre dossier téléchargement.');
        return Excel::download(new ProgramsMultiSheetExport($dateD,$dateF), 'Rapport.xlsx');
        /*return view('programs.rapportImprimer', [
            'programs' => $this->program->all(),
        ]);*/
        //return response()->json(['success' => 'true']);
    }

    public function rapport()
    {
        return view('programs.rapport');
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'nom' => 'required',
                'description' => '',
            ],
        );

        $this->program->update($request->code, $request->all());

        Alert::success('Opération Réussie', 'Le programme a été modifié avec succès!');
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nom = $this->program->get($request->code)->nom;
        $this->program->delete($request->code);
        Alert::success('Suppression', 'Le programme ' . $nom . ' a été supprimé avec succès!');

        return redirect()->route('programs.index');
    }

    public function show($code)
    {
        $program = Program::withTrashed()->where('id', $code)->first();
        return view('programs.show', [
            'program' => $program,
        ]);
    }
}
