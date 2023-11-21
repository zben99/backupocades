<?php

namespace App\Repositories;

use App\Models\Activitedocument;

class ActivitedocumentRepository implements ActivitedocumentRepositoryInterface
{
    public function get($id)
    {
        return Activitedocument::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Activitedocument::create([
            'url' => $data["url"],
            'activite_id' => $data["activite_id"]
        ]);
    }

    public function all()
    {
        return Activitedocument::orderBy('url')->get();
    }

    public function delete($id)
    {
        $activitedocument = Activitedocument::where('id', $id)->firstOrFail();
        $activitedocument->delete();
    }

    public function update($id, array $data)
    {
        $activitedocument = Activitedocument::where('id', $id)->firstOrFail();

        $activitedocument->update([
            'url' => $data["url"],
            'activite_id' => $data["activite_id"]
        ]);
    }
}
