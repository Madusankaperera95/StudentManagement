<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function showChangePasswordForm()
    {
        if(Auth::check()) {
            return view('auth.changepassword');
        }
        return redirect("login");
    }
    public function changePassword(Request $request){
        $user = Auth::user();

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        Session::flush();
        Auth::logout();

        return redirect()->route('login');

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        $userTypes=UserType::all();
        return view('auth.registration',compact('userTypes'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if(Auth::user()->userType->name=='student')
            {
                if(Auth::user()->first_login === 1){
                       $user=Auth::user();
                       $user->first_login=0;
                       $user->save();
                    return redirect('change-password');
                }
            }
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'registrationno' => 'required|min:6'
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return response()->json(['success'=>'New Student Record saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->userType->name=='student'){
                $subjects=$user->subjects;
                return view('studentdashboard',compact('subjects'));
            }

            return view('dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['registrationno']),
            'registrationno' => $data['registrationno'],
            'user_type_id' =>2,
            'first_login'=>1
        ]);
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
