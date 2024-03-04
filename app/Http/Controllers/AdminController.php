<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use App\Models\Agent;
use App\Models\Property;
use App\Models\Approval;
use App\Models\Inquire;
use App\Models\Customer_schedule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $admininfo = Admin::where('user_id', $user->id)->first();
        $properties = Property::All();

        return view('admin.index', compact('properties','admininfo'));
    }
    
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:11',
            'address' => 'required|string|max:255',
            'sex' => 'required|string|in:male,female',
            'birthdate' => 'required|date',

        ]);

        $birthdate = date('Y-m-d', strtotime($request->birthdate));
    
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    
        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->name = $request->name;
        $admin->phone_number = $request->phone_number;
        $admin->address = $request->address;
        $admin->sex = $request->sex;
        $admin->birthdate = $birthdate; 
        $admin->save();
        auth()->login($user);
    
        return redirect()->route('login.loginpage')->with('successregister', true);
    }
}
