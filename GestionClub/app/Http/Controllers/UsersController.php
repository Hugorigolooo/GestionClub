<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;


class UsersController extends Controller
{
    //
    public function index ()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(User $user) {
        return view('users.edit', compact('user'));
    }

    public function edit(User $user) {
        $this->isAbleToEdit($user);
        return view('users.edit', compact('user'));

    }

    public function update(Request $request, User $user) {
        // Afficher une valeur :
        // dd($request->input('name')); // On considère que notre requête contient un champ "name"

        $this->isAbleToEdit($user);

        // On valide les données
        $validatedData = $request->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'email' => 'required|email',
        ]);

        $user->update($validatedData);
        return redirect()->back()->with('success', 'Les informations ont bien été modifiées');

    }

    public function destroy(User $user) {

        if (!$user->admin){
            $this->isAbleToEdit($user);
            $user->delete();
//            return Redirect::route('users')->with('success', 'L\'utilisateur a bien été supprimé');
            return redirect()->back()->with('success', 'L\'utilisateur a bien été supprimé');

        }else{
//            return Redirect::route('users')->with('error', 'Vous ne pouvez pas supprimer un administrateur.');
            return redirect()->back()->with('success', 'L\'utilisateur a bien été supprimé');

        }

    }

    private function isAbleToEdit(User $user) {
        if($user->id == request()->user()->id
            and !request()->user()->admin) {
            abort(403);
        }
    }


}
