<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FileManager;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use stdClass;
use Toastr;
use DB;

class UserController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function __construct()
      {
          $this->middleware('permission:user-view|user-create|user-update|user-delete', ['only' => ['index']]);
          $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
          $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
          $this->middleware('permission:user-delete', ['only' => ['destroy']]);
          $this->page_title = 'User List';
          $this->access = 'user';
          $this->key_word = 'User';
          $this->path = 'admin.users';
          $this->route_index = 'admin.users.index';
          $this->route_create = 'admin.users.create';
          $this->route_show = 'admin.users.show';
          $this->route_edit = 'admin.users.edit';
          $this->route_update = 'admin.users.update';
          $this->route_destroy = 'admin.users.destroy';
          $this->route_store = 'admin.users.store';
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

        $rows = User::orderBy('id', 'DESC')->get();

        return view($this->path.'.index', compact('rows', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "User Create";
        $info->route_index = $this->route_index;
        $info->route_store = $this->route_store;
        $info->route_show = $this->route_show;
        $info->route_edit = $this->route_edit;
        $info->route_destroy = $this->route_destroy;

        return view($this->path.'.create', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
          ]);
       
       Toastr::success('Created Success!', $this->key_word);
       return redirect()->route($this->route_index);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route($this->route_index);
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
        $info->page_title = 'Edit '.$this->key_word;
        $info->key_word = $this->key_word;
        $info->access = $this->access;
        $info->route_index = $this->route_index;
        $info->route_update = $this->route_update;
        $info->route_show = $this->route_show;
        $info->route_edit = $this->route_edit;
        $info->route_destroy = $this->route_destroy;

        $row = User::findOrFail($id);
        return view($this->path.'.edit', compact('row', 'info'));
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

     $row = User::findOrFail($id);
     $row->update([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
     ]);

        Toastr::success('Updated Success!', $this->key_word);
        return redirect()->route($this->route_index);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->deletable){
            $user->delete();
          Toastr::success('Delete Success!', $this->key_word);
          return redirect()->route($this->route_index);
        }
        Toastr::error('Delete Fail!', $this->key_word);
        return redirect()->route($this->route_index);
    }
}
