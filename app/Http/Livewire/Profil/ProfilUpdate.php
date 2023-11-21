<?php

namespace App\Http\Livewire\Profil;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ProfilUpdate extends Component
{
    public $username;
    public $password;
    public $confirm;
    public $user;
    public $data;
    public $monPseudo;

    public function mount($user)
    {
        $this->user = $user;
        $this->username = $this->username ?? $user->username;
        $this->monPseudo = $user->username;
        $this->password = $this->password;
        $this->confirm = $this->confirm;
    }

    public function updated($field)
    {
        $this->validateOnly(
            $field,
            [
                'username' => ($this->username == $this->monPseudo) ? 'required|string' : 'required|string|unique:users',
                'password' => 'required|string|min:10|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/',
                'confirm' => 'required|string|min:10|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/',

            ],
            [
                'username.unique' => 'Ce pseudo est déjà utilisé',

            ]
        );
    }

    public function render()
    {
        return view('livewire.profil.profil-update', [
            'user' => $this->user,
        ]);
    }

    public function updateProfil()
    {
        $this->data = $this->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:10|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/',
            'confirm' => 'required|string|min:10|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/',

        ]);

        if ($this->data['password'] != $this->data['confirm']) {
            session()->flash('erreur', "Les deux mots de passe saisies ne sont pas identiques");
        } else {
            $this->user->update([
                'username' => $this->data["username"],
                'password' => Hash::make($this->data["password"]),
            ]);

            session()->flash('success', "Vos identifiants ont été modifiés avec succès. Veuillez vous connecté avec vos nouveaux identifiants!");
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
