<?php

namespace App\Http\Livewire;

use App\Models\Direction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{

    public $name;
    public $forname;
    public $username;
    public $code_dir;
    public $roles = [];

    public function updated($field)
    {
        $this->validateOnly(
            $field,
            [
                'name' => 'required|string',
                'forname' => 'required|string',
                'code_dir' => 'required',
                'username' => 'required|string|unique:users',
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
        return view('livewire.users', [
            'users' => User::all(),
            'roles_t' => Role::all(),
            'directions' => Direction::all(),
        ]);
    }

    public function store()
    {

        $data = $this->validate(
            [
                'name' => 'required|string',
                'forname' => 'required|string',
                'code_dir' => 'required',
                'roles' => 'required',
                'username' => 'required|string|unique:users',
            ],

            [
                'name.required' => 'Veuillez renseigner le nom',
                'roles.required' => 'Veuillez attribuer des roles',
                'name.string' => 'Le nom doit être une chaîne de caractères',
                'username.required' => 'Veuillez renseigner le pseudo',
                'username.string' => 'Le prénom doit être une chaîne de caractères',
                'username.unique' => 'Ce pseudo est déjà utilisé',
                'forname.required' => 'Veuillez renseigner le(s) prénom(s)',
                'forname.string' => 'Le prénom doit être une chaîne de caractères',
                'code_dir.required' => 'Veuillez choisir la direction',
            ],
        );

        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'forname' => $data['forname'],
            'code_dir' => $data['code_dir'],
            'owner' => Auth::user()->id,
            'password' => Hash::make('kougni'),
        ]);

        $roles = $data['roles'];
        foreach ($roles as $role) {
            $user->roles()->attach((int)$role);
        }
        $user->save();
        toast('L\'utilisateur a été ajouté avec succès!', 'success');
        return redirect()->route('admin.users.index');
    }
}
