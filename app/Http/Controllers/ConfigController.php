<?php

namespace App\Http\Controllers;

use App\Repositories\ConfigRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigController extends Controller
{
    protected $config;

    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->middleware('auth');
        $this->config = $config;
    }

    public function index()
    {
        return view('parametres.configs.index', [
            'config' => $this->config->get(),
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'email' => 'email|nullable',
                'nom' => 'required',
            ],
        );

        $this->validate($request, [
            'logotmp.*' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $config = $this->config->get();
        $input = $request->all();
        if ($request->hasfile('logotmp')) {
            $file = $request->file('logotmp');
            $date = date("Y_m_d_H_i_s");
            $name = $date . "_" . $file->getClientOriginalName();
            $file->move(public_path().'/logo/', $name);
            $input["logo"] = $name;
        }else{
            $input["logo"] = $config->logo ;
        }

        $this->config->update($id, $input);
        Alert::success('Opération Réussie', 'Le config a été modifié avec succès!');
        return redirect()->route('configs.index');
    }

    
}