<?php

namespace App\Repositories;

use App\Models\VieOrganisation;
use Illuminate\Support\Facades\Auth;

class VieOrganisationRepository implements VieOrganisationRepositoryInterface
{
    public function get($id)
    {
        return VieOrganisation::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        VieOrganisation::create([
            'nom'=> $data["nom"],
            'auteur'=> $data["auteur"],
            'nb_pages'=> $data["nb"],
            'resume'=> $data["resume"],
            'date_publication'=> $data["date_publication"],
            'type_document_id'=> $data["type_document_id"],
            'logo'=> $data["logo"],
            'agent'=> Auth::user()->id,
        ]);
    }

    public function all()
    {
        return VieOrganisation::orderByDesc('created_at')->get();
    }

    public function delete($id)
    {
        $typeDocument = VieOrganisation::where('id', $id)->firstOrFail();
        $typeDocument->delete();
    }

    public function update($id, array $data)
    {
        $typeDocument = VieOrganisation::where('id', $id)->firstOrFail();

        $typeDocument->update([
            'nom'=> $data["nom"],
            'auteur'=> $data["auteur"],
            'nb_pages'=> $data["nb"],
            'resume'=> $data["resume"],
            'date_publication'=> $data["date_publication"],
            'logo'=> $data["logo"]
        ]);
    }
}
