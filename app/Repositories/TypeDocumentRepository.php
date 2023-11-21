<?php

namespace App\Repositories;

use App\Models\TypeDocument;

class TypeDocumentRepository implements TypeDocumentRepositoryInterface
{
    public function get($id)
    {
        return TypeDocument::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        TypeDocument::create([
            'libelle' => $data["libelle"],
        ]);
    }

    public function all()
    {
        return TypeDocument::orderBy('libelle')->get();
    }

    public function delete($id)
    {
        $typeDocument = TypeDocument::where('id', $id)->firstOrFail();
        $typeDocument->delete();
    }

    public function update($id, array $data)
    {
        $typeDocument = TypeDocument::where('id', $id)->firstOrFail();

        $typeDocument->update([
            'libelle' => $data["libelle"],
        ]);
    }
}
