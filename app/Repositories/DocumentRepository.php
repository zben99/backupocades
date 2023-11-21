<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function get($id)
    {
        return Document::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Document::create([
            'url' => $data["url"],
            'projet_id' => $data["projet_id"]
        ]);
    }

    public function all()
    {
        return Document::orderBy('url')->get();
    }

    public function delete($id)
    {
        $document = Document::where('id', $id)->firstOrFail();
        $document->delete();
    }

    public function update($id, array $data)
    {
        $document = Document::where('id', $id)->firstOrFail();

        $document->update([
            'url' => $data["url"],
            'projet_id' => $data["projet_id"]
        ]);
    }
}
