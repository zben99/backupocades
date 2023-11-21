<?php

namespace App\Repositories;

use App\Models\Config;

class ConfigRepository implements ConfigRepositoryInterface
{

    public function get()
    {
        return Config::firstOrFail();
    }
   

    public function update($id, array $data)
    {
        $config = Config::where('id', $id)->firstOrFail();

        $config->update([
            'nom' => $data["nom"],
            'logo' => $data["logo"],
            'email' => $data["email"],
            'telephone' => $data["telephone"],
            'site' => $data["site"],
            'adresse' => $data["adresse"]
        ]);
        return $config;
    }

}