<?php
namespace App\Http\Controllers\UserManagement;
use DB;
use Hash;
//custom Spatie\Permission
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);

        return view('users.index',compact('data'))
                                ->with('i', ($request->input('page', 1)-1) * 5);
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $depts=Department::pluck('name','id')->all();
        return view('users.create',compact('roles','depts'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'=>'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'department_id'=>'required',
            'password' => 'same:confirm-password',
            'roles' => 'required']);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User created successfully');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $depts=Department::pluck('name','id')->all();
        return view('users.edit',compact('user','roles','userRole','depts'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username'=>'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'department_id'=>'required',
            'password' => 'same:confirm-password',
            'roles' => 'required']);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index') ->with('success','User deleted successfully');
    }
}