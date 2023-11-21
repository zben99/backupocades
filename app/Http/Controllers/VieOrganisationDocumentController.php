<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\VieOrganisationDocumentRepositoryInterface;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Response as FacadesResponse;

class VieOrganisationDocumentController extends Controller
{
    protected $fichier;

    public function __construct(VieOrganisationDocumentRepositoryInterface $fichier)
    {
        $this->middleware('auth');
        $this->fichier = $fichier;
    }

    public function document_upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $completeFileName = $image->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $imageName = $request->code_doc . '_' . str_replace(' ', '', $fileNameOnly) . '.' . $image->extension();
            $image->move(public_path('telechargements/documents'), $imageName);

            $this->fichier->add($request->code_doc, $imageName);

            return response()->json(['success' => $imageName]);
        }

        return redirect()->route('documents.index');
    }

    public function destroy(Request $request)
    {
        $filename =  $request->code;
        $nom_court = $request->nom;
        $this->fichier->delete($filename);
        Alert::success('Suppression de Fichier', 'Le fichier ' . $nom_court . ' a été supprimé avec succès!');
        return back();
    }

    public function open($filename)
    {
        $path = public_path('/telechargements/documents/' . $filename);
        if (!FacadesFile::exists($path)) {
            Alert::error('Echec D\'ouverture', 'Impossible de trouver le fichier!');
            return redirect()->back();
        }
        $file = FacadesFile::get($path);
        $type = FacadesFile::mimeType($path);
        $response = FacadesResponse::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
