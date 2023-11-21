<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class ProgramRepository implements ProgramRepositoryInterface
{
    public function get($id)
    {
        return Program::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Program::create([
            'nom' => $data["nom"],
            'description' => $data["description"],
            'agent' => Auth::user()->id,
        ]);
    }

    public function all()
    {
        return Program::orderBy('nom')->get();
    }

    public function delete($id)
    {
        $program = Program::where('id', $id)->firstOrFail();
        $program->delete();
    }

    public function update($id, array $data)
    {
        $program = Program::where('id', $id)->firstOrFail();

        $program->update([
            'nom' => $data["nom"],
            'description' => $data["description"],
        ]);
    }
}
