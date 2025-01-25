<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return response()->json(['user' => $user, 'token' => $user->createToken('API Token')->plainTextToken]);
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

    $user = Auth::user();
    return response()->json(['user' => $user, 'token' => $user->createToken('API Token')->plainTextToken]);
}
<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User diimport
use Illuminate\Http\Request; // Pastikan Request diimport
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller // Tambahkan deklarasi class
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }
}
