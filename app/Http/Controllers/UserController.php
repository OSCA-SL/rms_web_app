<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if (auth()->user()->isAdmin()) {
            $users = User::all();
        }
        else{
            $users = User::where('id', auth()->user()->id)->get();
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('users.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->isAdmin()){
            $user = new User;
            $user->first_name = $request->input('first_name') !=""?$request->input('first_name'):"";
            $user->last_name = $request->input('last_name') !=""?$request->input('last_name'):"";
            if ($request->input('email') !=""){
                $user->email = $request->input('email');
            }
            else{
                $user->email = str_replace(' ', '', "rmsosca+".$user->first_name.".".$user->last_name."@gmail.com");
            }
            $user->dob = $request->input('dob') !=""?$request->input('dob'):null;
            $user->nic = $request->input('nic') !=""?$request->input('nic'):null;
            $user->mobile = $request->input('mobile') !=""?$request->input('mobile'):null;
            $user->land = $request->input('land') !=""?$request->input('land'):null;
            $user->address = $request->input('address') !=""?$request->input('address'):null;
            $user->role = $request->input('role') !=""?$request->input('role'):4;
            $user->added_by = auth()->user()->id;
            $user->password = Hash::make($request->input('nic'));
            $user->save();

            return redirect()->route('users.index')->with('status', 'Successfully saved the user data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->isAdmin()){
            $users = User::all();
            return view('users.edit', [ 'user' => $user, 'users' => $users]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->isAdmin()){
            $user->first_name = $request->input('first_name') !=""?$request->input('first_name'):"";
            $user->last_name = $request->input('last_name') !=""?$request->input('last_name'):"";
            if ($request->input('email') !=""){
                $user->email = $request->input('email');
            }
            else{
                $user->email = str_replace(' ', '', "rmsosca+".$user->first_name.".".$user->last_name."@gmail.com");
            }
            $user->dob = $request->input('dob') !=""?$request->input('dob'):null;
            $user->nic = $request->input('nic') !=""?$request->input('nic'):null;
            $user->mobile = $request->input('mobile') !=""?$request->input('mobile'):null;
            $user->land = $request->input('land') !=""?$request->input('land'):null;
            $user->address = $request->input('address') !=""?$request->input('address'):null;
            $user->role = $request->input('role') !=""?$request->input('role'):4;
            $user->updated_by = auth()->user()->id;
            $user->password = Hash::make($request->input('nic'));
            $user->save();

            return redirect()->route('users.index')->with('status', 'Successfully updated the user data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->isAdmin()){
            $user->deleted_by = auth()->user()->id;
            $user->save();

            $user->artists()->delete();

            $user->delete();


            return response("Successfully deleted the user", 204);
        }
    }
}
