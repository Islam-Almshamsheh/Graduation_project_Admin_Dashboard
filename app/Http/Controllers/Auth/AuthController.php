<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login'); // create a simple login form view
    }

    // Admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Authenticate via Firebase Auth
        $authResponse = $this->firebase->signInWithEmailAndPassword(
            $request->email,
            $request->password
        );

        if (isset($authResponse['error'])) {
            return back()->withErrors(['email' => $authResponse['error']['message'] ?? 'Login failed.']);
        }

        $uid = $authResponse['localId']; // Firebase UID

        // Fetch admin info from Firestore using UID
        $doc = $this->firebase->getCollection('admins');
        $adminFound = null;
        if (isset($doc['documents'])) {
            foreach ($doc['documents'] as $d) {
                if (isset($d['fields']['uid']['stringValue']) && $d['fields']['uid']['stringValue'] === $uid) {
                    $adminFound = $d['fields'];
                    $adminFound['id'] = basename($d['name']); // keep document ID if needed
                    break;
                }
            }
        }

        if (!$adminFound) {
            return back()->withErrors(['email' => 'Admin record not found in Firestore.']);
        }

        // Save admin in session
        Session::put('admin', [
            'id' => $adminFound['id'],
            'email' => $request->email,
            'name' => $adminFound['name']['stringValue'] ?? null,
            'uid' => $uid,
        ]);

        return redirect()->route('admin.dashboard');
    }


    // Admin logout
    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('auth.login');
    }
}
