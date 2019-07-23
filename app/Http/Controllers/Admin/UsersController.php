<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $admins = Admin::all();
        return view('admin.users.index',compact('admins','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric','unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $request['password'] = Hash::make($request->password);
        $user = Admin::create($request->all());
        $user->roles()->sync($request->role);
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric','unique:admins,phone,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,'.$id],
        ]);
        $request->status ? : $request['status']=0;
        $user = Admin::where('id',$id)->update($request->except('_token','_method','role'));
        Admin::find($id)->roles()->sync($request->role);
        Flashy::success('Les informations ont bien été mis à jour');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::where('id',$id)->delete();

        Flashy::success('L\'administrateur a été suprimé');
        return redirect()->back();
    }

    public function role ()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.role',compact('roles','permissions'));
    }

    public function roleStore (Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:roles',
        ]);
        $role = new Role();
        $role->name = $request->name;

        $role->save();
        $role->permissions()->sync($request->permission);
        return redirect()->route('admin.user.role');
    }

    public function roleEdit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.users.roleEdit',compact('role','permissions'));
    }

    public function roleUpdate(Request $request, Role $role)
    {
        // return $request->all();
        $this->validate($request,[
            'name' => 'required|max:50',
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permission);
        return redirect()->route('admin.user.role');
    }

    public function roleDestroy(Role $role)
    {
        // dd($role);
        $role->delete();
        Flashy::error("le rôle a été supprimé");
        return redirect()->back();
    }
}
