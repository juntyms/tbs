<?php

namespace App\Http\Controllers\Auth;

use Adldap\Adldap;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $config=array(
            'user_id_key'=>'samaccountname',
            'account_suffix'=> '@sct.edu.om',
            'base_dn' => 'DC=sct,DC=edu,DC=om',
            'domain_controllers'=> array('10.153.7.4'),
            'admin_username'=>env('LDAP_USER',''),
            'admin_password'=> env('LDAP_PASS',''),
            'real_primarygroup' =>true,
            'use_ssl'=>false,
            'use_tls'=>false,
            'recursive_groups' =>true,
            'ad_port'=>'389',
            'sso'=>false,                
        );
        $username=$request->username;
        $password=$request->password;
        $user=User::where('username',$username)->first();

        if($user){
            if(empty($user->password))
            {
                
                $ad=new Adldap($config);

                if($ad->user()->authenticate($username,$password)){
                    Auth::login($user);
                    
                    return redirect()->route('home');

                }
                return redirect()->route('login')->withErrors(['username' => 'The provided credentials do not match our records.']);

            }else{
                if(Auth::attempt(['username'=>$username,'password'=>$password]))
                {
                    return redirect()->route('home');

                }
                return redirect()->route('login')->withErrors(['username' => 'The provided credentials do not match our records.']);
            }
        }
        else
        {
            $ad=new Adldap($config);
            if($ad->user()->authenticate($username,$password)){
                
                $result=$ad->user()->info($username, array("name","displayname","department","mail"));
                $username=$result["name"];
                $fullname=$result["displayname"];
                $email=$result["mail"];
                $department_name=$result["department"];
                $departmentid=Department::where('name',$department_name)->first();

                $Adduser=User::create(['username'=>$username,
                                        'fullname'=>$fullname,
                                        'email'=>$email,
                                        'department_id'=>$departmentid->id]);
                        
                $insertedid=$Adduser->id;
                $user=User::findOrFail($insertedid);
                $user->assignRole('student-role');
                Auth::login($user);

            }
            return redirect()->route('login')->withErrors(['username' => 'The provided credentials do not match our records.']);


        }
    }
   
}
