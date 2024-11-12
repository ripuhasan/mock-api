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
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = new stdClass();
        $info->page_title = 'User List';
        $info->access = 'user';
        $info->key_word = 'User';
        $info->route_index = 'admin.users.index';
        $info->route_store = 'admin.users.store';
        $info->route_show = 'admin.users.show';
        $info->route_edit = 'admin.users.edit';
        $info->route_destroy = 'admin.users.destroy';

        $rows = User::orderBy('id', 'DESC')->get();

        return view('admin.users.index', compact('rows', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = new stdClass();
        $info->access = 'user';
        $info->key_word = 'User';
        $info->page_title = "User Create";
        $info->route_index = 'admin.users.index';
        $info->route_store = 'admin.users.store';
        $info->route_show = 'admin.users.show';
        $info->route_edit = 'admin.users.edit';
        $info->route_destroy = 'admin.users.destroy';

        return view('admin.users.create', compact('info'));
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
       
       Toastr::success('Created Success!', 'success');
       return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('admin.users.index');
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
        $info->page_title = 'Edit User';
        $info->key_word = 'User';
        $info->access = 'user';
        $info->route_index = 'admin.users.index';
        $info->route_update = 'admin.users.update';
        $info->route_show = 'admin.users.show';
        $info->route_edit = 'admin.users.edit';
        $info->route_destroy = 'admin.users.destroy';

        $row = User::findOrFail($id);
        return view('admin.users.edit', compact('row', 'info'));
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

        Toastr::success('Updated Success!', 'success');
        return redirect()->route('admin.users.index');
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
          Toastr::success('Delete Success!', 'success');
          return redirect()->route('admin.users.index');
        }
        Toastr::error('Delete Fail!', 'fail');
        return redirect()->route('admin.users.index');
    }
}
