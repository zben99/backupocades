<?php

namespace App\Http\Livewire;

use App\Models\Direction;
use App\Models\Role;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Usersupdate extends Component
{

    public $name;
    public $forname;
    public $username;
    public $code_dir;
    public $roles = [];
    public $monPseudo;
    public $user;
    public $roles_t;
    public $old_roles;
    public $cpt = 0;

    public function mount($user)
    {
        $this->user = $user;
        $this->monPseudo = $user->username;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->forname = $user->forname;
        $this->code_dir = $user->code_dir;
        $mesRoles = $user->roles->pluck('id');
        foreach ($mesRoles as $value) {
            array_push($this->roles, $value);
        }
        $this->roles_t = Role::all();
    }

    public function updated($field)
    {
        $this->validateOnly(
            $field,
            [
                'name' => 'required|string',
                'forname' => 'required|string',
                'code_dir' => 'required',
                //Tester si l'utilisateur garde son pseudo ou pas avant de chercher si c'est disponible ou pas
                'username' => ($this->username == $this->monPseudo) ? 'required|string' : 'required|string|unique:users',
            ],

            [
                'name.required' => 'Veuillez renseigner le nom',
                'name.string' => 'Le nom doit être une chaîne de caractères',
                'username.required' => 'Veuillez renseigner le pseudo',
                'username.string' => 'Le prénom doit être une chaîne de caractères',
                'username.unique' => 'Ce pseudo est déjà utilisé',
                'forname.required' => 'Veuillez renseigner le(s) prénom(s)',
                'forname.string' => 'Le prénom doit être une chaîne de caractères',
                'code_dir.required' => 'Veuillez choisir la direction',
            ],
        );
    }

    public function render()
    {

        return view('livewire.usersupdate', [
            'user' => $this->user,
            'roles_t' => $this->roles_t,
            'directions' => Direction::all(),
        ]);
    }

    public function updateUser()
    {
        $data = $this->validate(
            [
                'name' => 'required|string',
                'forname' => 'required|string',
                'code_dir' => 'required',
                'roles' => 'required',
                'username' => 'required|string',
            ],

            [
                'name.required' => 'Veuillez renseigner le nom',
                'name.string' => 'Le nom doit être une chaîne de caractères',
                'username.required' => 'Veuillez renseigner le pseudo',
                'username.string' => 'Le prénom doit être une chaîne de caractères',
                'username.unique' => 'Ce pseudo est déjà utilisé',
                'forname.required' => 'Veuillez renseigner le(s) prénom(s)',
                'forname.string' => 'Le prénom doit être une chaîne de caractères',
                'roles.required' => 'veuillez choisir au moins un rôle',
            ],
        );

        $this->user->roles()->sync($data['roles']);

        $this->user->username = $data['username'];
        $this->user->name = $data['name'];
        $this->user->forname = $data['forname'];
        $this->user->code_dir = $data['code_dir'];
        $this->user->save();
        Alert::success('Modification', 'L\'utilisateur a été modifié avec succès!');

        return redirect()->route('admin.users.index');
    }
}
