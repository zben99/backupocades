<?php

namespace App\Repositories;

use App\Models\Province;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    public function get($id)
    {
        return Province::where('id', $id)->firstOrFail();
    }

    public function add(array $data)
    {

        Province::create([
            'province' => $data["province"],
            'description' => $data["description"],
            'region_id' => $data["region_id"],
        ]);
    }

    public function all()
    {
        return Province::orderBy('province')->get();
    }

    public function delete($id)
    {
        $province = Province::where('id', $id)->firstOrFail();
        $province->delete();
    }

    public function update($id, array $data)
    {
        $province = Province::where('id', $id)->firstOrFail();

        $province->update([
            'province' => $data["province"],
            'description' => $data["description"],
            'region_id' => $data["region_id"],
        ]);
    }
}
