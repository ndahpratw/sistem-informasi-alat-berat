<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        return view('pages.customer.profile', compact('data'));
    }

    public function showRegistrationForm()
    {
        return view('registrasi');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:staff',
            'password' => 'required|string|min:8|confirmed',
            'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: untuk validasi profile
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
          // Upload profile jika ada
          if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $imageName = now()->format('YmdHis') . $request->email . '.' . $profile->extension();
            $profile->move(public_path('assets/img/profile/'), $imageName);
        } else {
            $imageName = null;
        }
    
        Staff::create([
            'name' => $request->name,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Pelanggan', // Set role to 'Pelanggan' by default
            'profile' => $imageName,
        ]);
    
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
