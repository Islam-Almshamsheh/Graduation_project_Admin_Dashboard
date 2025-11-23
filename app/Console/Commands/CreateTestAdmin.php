<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateTestAdmin extends Command
{
    protected $signature = 'firebase:create-admin';
    protected $description = 'Create a test admin in Firebase Auth and Firestore';

    public function handle()
    {
        $firebase = new FirebaseService();

        $email = 'admin1@example.com';
        $password = 'admin123';
        $fullName = 'Super Admin';

        // 1️⃣ Create Firebase Auth user
        $authResponse = $firebase->createAuthUser($email, $password);

        if (isset($authResponse['error'])) {
            $this->error('Firebase Auth error: ' . $authResponse['error']['message']);
            return 1;
        }

        $uid = $authResponse['localId']; // UID from Firebase Auth

        // 2️⃣ Prepare Firestore admin data
        $adminData = [
            'uid' => $uid,
            'email' => $email,
            'name' => $fullName,
            'role' => 'admin',
            'password' => Hash::make($password),
            'image_url' => 'Optional profile image URL',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        // 3️⃣ Store in Firestore under 'admins' collection
        $firestoreResponse = $firebase->createDocument('admins', $adminData);

        $this->info('Admin created successfully in Auth and Firestore!');
        $this->line(print_r($firestoreResponse, true));

        return 0;
    }
}
