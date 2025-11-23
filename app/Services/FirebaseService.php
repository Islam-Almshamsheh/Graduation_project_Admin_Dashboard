<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class FirebaseService
{
    protected $client;
    protected $projectId;

    public function __construct()
    {
        $this->projectId = env('FIREBASE_PROJECT_ID');
        $this->client = new Client([
            'base_uri' => "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents/",
            'verify' => false,
        ]);
    }

    public function createDocument($collection, $data)
    {
        $formattedFields = [];

        foreach ($data as $key => $value) {
            // Automatically detect type for simplicity, here we use stringValue
            $formattedFields[$key] = ['stringValue' => $value];
        }

        $response = $this->client->post($collection, [
            'json' => ['fields' => $formattedFields]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getCollection($collection)
    {
        $response = $this->client->get($collection);
        return json_decode($response->getBody(), true);
    }

    public function deleteDocument($collection, $documentId)
    {
        $response = $this->client->delete("{$collection}/{$documentId}");
        return json_decode($response->getBody(), true);
    }

    protected function formatFields(array $data)
    {
        $formatted = [];
        foreach ($data as $key => $value) {
            // Detect common types: string, number, boolean, array, timestamp
            if (is_string($value)) {
                $formatted[$key] = ['stringValue' => $value];
            } elseif (is_int($value) || is_float($value)) {
                $formatted[$key] = ['doubleValue' => (float)$value];
            } elseif (is_bool($value)) {
                $formatted[$key] = ['booleanValue' => $value];
            } elseif (is_array($value)) {
                // arrays -> arrayValue of stringValue items
                $items = [];
                foreach ($value as $item) {
                    if (is_string($item)) {
                        $items[] = ['stringValue' => $item];
                    } elseif (is_int($item) || is_float($item)) {
                        $items[] = ['doubleValue' => (float)$item];
                    } else {
                        // fallback to string
                        $items[] = ['stringValue' => (string)$item];
                    }
                }
                $formatted[$key] = ['arrayValue' => ['values' => $items]];
            } elseif ($value instanceof \DateTime) {
                $formatted[$key] = ['timestampValue' => $value->format(DATE_ATOM)];
            } elseif ($value === null) {
                $formatted[$key] = ['nullValue' => null];
            } else {
                // fallback
                $formatted[$key] = ['stringValue' => (string)$value];
            }
        }
        return $formatted;
    }

    // -------------------------
    // Firebase Auth (REST) methods
    // -------------------------

    // Create a Firebase Auth user (email + password)
    public function createAuthUser(string $email, string $password)
    {
        $apiKey = env('FIREBASE_API_KEY');
        $url = "https://identitytoolkit.googleapis.com/v1/accounts:signUp?key={$apiKey}";
        $client = new \GuzzleHttp\Client([
                                                    'base_uri' => 'https://identitytoolkit.googleapis.com/v1/',
                                                    'verify' => false, // <-- ADD THIS LINE(temprory fix of error 60 of curl when running "php artisan firebase:create-admin")
    // ... other options
]);

        try {
            $response = $client->post($url, [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'returnSecureToken' => true
                ],
                'http_errors' => false
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['error'])) {
                return ['error' => $body['error']];
            }

            // Returns idToken, localId (uid), refreshToken, expiresIn
            return $body;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['error' => ['message' => $e->getMessage()]];
        }
    }

// Sign in (email + password)
    public function signInWithEmailAndPassword(string $email, string $password)
    {
        $apiKey = env('FIREBASE_API_KEY');
        $url = "https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key={$apiKey}";
        $client = new \GuzzleHttp\Client([
                                                    'base_uri' => 'https://identitytoolkit.googleapis.com/v1/',
                                                    'verify' => false, // <-- ADD THIS LINE(temprory fix of error 60 of curl when running "php artisan firebase:create-admin")
    // ... other options
]);

        try {
            $response = $client->post($url, [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'returnSecureToken' => true
                ],
                'http_errors' => false
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['error'])) {
                return ['error' => $body['error']];
            }

            return $body;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['error' => ['message' => $e->getMessage()]];
        }
    }
    // Optional helper to create a Firestore doc with a specific document path (e.g., admins/{uid})
    public function createDocumentAtPath(string $path, array $data)
    {
        // path example: "admins/UID" (no leading slash)
        $formattedFields = $this->formatFields($data);

        $response = $this->client->patch($path, [
            'json' => ['fields' => $formattedFields]
        ]);

        return json_decode($response->getBody(), true);
    }
}
