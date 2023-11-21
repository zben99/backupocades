<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::all();

        $roles = Role::all();

        $users = User::all();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
            'directions' => $directions
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Test si l'utilisateur n'a pas les roles pour editer
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.users.index');
        }

        $directions = Direction::all();
        $roles = Role::all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'directions' => $directions
        ]);
    }

    public function activate($id)
    {
        $user = User::find($id);
        ($user->state == 0) ? $user->state = 1 : $user->state = 0;
        $user->save();

        if ($user->state) {
            Alert::success('Activation Réussie', 'L\'utilisateur a été activé avec succès!');
        } else {
            Alert::success('Desactivation Réussie', 'L\'utilisateur a été desactivé avec succès!');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Test si l'utilisateur n'a pas les roles pour supprimer
        if (Gate::denies('admin')) {
            return redirect()->route('admin.users.index');
        }
        $user = User::whereId($request->id)->firstOrFail();

        $user->roles()->detach(); // Detacher tous les roles
        $user->delete();
        Alert::success('Suppression', 'L\'utilisateur a été supprimé avec succès!');

        return redirect()->route('admin.users.index');
    }
}