<?php

namespace App\Repositories;

use App\Models\VieOrganisationDocument;

class VieOrganisationDocumentRepository implements VieOrganisationDocumentRepositoryInterface
{

    public function add($code_doc, $filename)
    {
        VieOrganisationDocument::create([
            'url' => $filename,
            'vie_organisation_id'=> $code_doc
        ]);
    }


    public function delete($filename)
    {
        VieOrganisationDocument::where('url', $filename)->delete();
        $path = public_path() . '/telechargements/documents/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }



    public function update($id, array $data)
    {
        $typeDocument = VieOrganisationDocument::where('id', $id)->firstOrFail();

        $typeDocument->update([
            'url' => $data["url"],
            'vie_organisation_id'=> $data["vie_organisation_id"]
        ]);
    }
}
