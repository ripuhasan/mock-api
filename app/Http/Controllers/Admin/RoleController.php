<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use stdClass;
use Toastr;
use DB;

class RoleController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function __construct()
    {
        $this->middleware('permission:role-view|role-create|role-update|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->page_title = 'Role List';
        $this->access = 'role';
        $this->key_word = 'Role';
        $this->key_word_plural = 'Roles';
        $this->path = 'admin.roles';
        $this->route_index = 'admin.roles.index';
        $this->route_create = 'admin.roles.create';
        $this->route_show = 'admin.roles.show';
        $this->route_edit = 'admin.roles.edit';
        $this->route_update = 'admin.roles.update';
        $this->route_destroy = 'admin.roles.destroy';
        $this->route_store = 'admin.roles.store';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = new stdClass();
        $info->page_title = $this->page_title;
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->route_index = $this->route_index;
        $info->route_store = $this->route_store;
        $info->route_show = $this->route_show;
        $info->route_edit = $this->route_edit;
        $info->route_destroy = $this->route_destroy;

        $rows = Role::orderBy('id', 'DESC')->get();
        $permission = Permission::get();
        return view($this->path.'.index', compact('rows', 'permission', 'info'));
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
        DB::beginTransaction();
        $role = Role::create(['name' => $request->input('name'), 'slug' => Str::slug($request->input('name'), '-')]);
        $role->syncPermissions($request->input('permission'));
        DB::commit();
        
        Toastr::success('Created Success!', 'Success');
        return redirect()->route('admin.roles.index')
               ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = new stdClass();
        $info->route_destroy = $this->route_destroy;
        $info->page_title = $this->page_title;
        $info->key_word = $this->key_word;

        $row = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view($this->path.'.show', compact('row', 'rolePermissions', 'info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = new stdClass();
        $info->route_destroy = $this->route_destroy;

        $row = Role::find($id);
        $rows = Role::orderBy('id', 'DESC')->get();
        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->get();

        return view($this->path.'.edit', compact('row', 'rows', 'permission', 'rolePermissions', 'info'));
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
        DB::beginTransaction();
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        DB::commit();

        Toastr::success('Updated Success!', 'Success');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if($role->deletable){
            $role->delete();

            Toastr::success('Role deleted Success!', 'Success');
            return redirect()->route('admin.roles.index');
        }

        Toastr::warning('Role delete fail!', 'Fail');
        return redirect()->route('admin.roles.index');
    }
}
