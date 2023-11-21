<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('auth.profil', [
            'user' => Auth::user(),
        ]);
    }

    public function edit($code)
    {
        $newPass = "Ocades@2021";
        $user = User::whereId($code)->first();
        $user->update([
            'password' => Hash::make($newPass),
        ]);
        session()->flash('success', " Réinitialisation Réussie: le nouveau mot de passe de " . $user->username . " est: " . $newPass);

        return redirect()->route('admin.users.index');
    }

    public function changePhoto(Request $request)
    {
        // modification de l'avatar
        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('telechargements/avatars'), $filename);
            $user = User::whereId($request->code_user)->first();
            $user->avatar = $filename;
            $user->save();
        }
        Alert::success('Modification Réeussie', 'La photo a été changée avec succès!');
        return redirect()->route('profil.index');
    }

    public function first($id)
    {
        $user = User::whereId($id)->first();
        return view('auth.firstConnection', [
            'user' => $user,
        ]);
    }
}
