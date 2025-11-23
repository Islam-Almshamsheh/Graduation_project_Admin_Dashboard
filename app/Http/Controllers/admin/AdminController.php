<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FirebaseService;

class AdminController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    // Create a new admin
    public function createAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string|max:255'
        ]);

        $adminData = [
            'email' => $request->email,
            'password' => $request->password, // Note: Firebase Auth will hash it
            'full_name' => $request->full_name,
            'role' => 'admin',
        ];

        $result = $this->firebase->createDocument('admins', $adminData);

        return response()->json([
            'success' => true,
            'admin' => $result
        ]);
    }
}
