<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Carbon\Carbon;

class StudentController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    // List all students
    public function index()
    {
        $students = $this->firebase->getCollection('students');
        $admins = $this->firebase->getCollection('admins');
        $studentsList = [];
        if (isset($students['documents'])) {
            foreach ($students['documents'] as $doc) {
                $fields = $doc['fields'];
                $studentsList[] = [
                    'uid' => $fields['uid']['stringValue'] ?? null,
                    'full_name' => $fields['full_name']['stringValue'] ?? null,
                    'email' => $fields['email']['stringValue'] ?? null,
                    'department' => $fields['department']['stringValue'] ?? null,
                    'major' => $fields['major']['stringValue'] ?? null,
                    'academic_year' => $fields['academic_year']['stringValue'] ?? null,
                    'gpa' => $fields['gpa']['integerValue'] ?? null,
                    'completed_courses' => isset($fields['completed_courses']['arrayValue']['values'])
                    ? array_map(fn($v) => $v['stringValue'] ?? null, $fields['completed_courses']['arrayValue']['values'])
                    : [],
                    'registered_courses' => isset($fields['registered_courses']['arrayValue']['values'])
                    ? array_map(fn($v) => $v['stringValue'] ?? null, $fields['registered_courses']['arrayValue']['values'])
                    : [],
                    'total_credit_hours' => $fields['total_credit_hours']['integerValue'] ?? null,
                ];
            }
        }
        $adminsList = [];
        if (isset($admins['documents'])) {
            foreach ($admins['documents'] as $doc) {
                $fields = $doc['fields'];
                $adminsList[] = [
                    'uid' => $fields['uid']['stringValue'] ?? null,
                    'full_name' => $fields['full_name']['stringValue'] ?? null,
                    'email' => $fields['email']['stringValue'] ?? null,
                ];
            }
        }

        return view("admin.students.index", ["students" => $studentsList, "admins" => $adminsList]);
    }

    // Show a single student
    public function show($uid)
    {
        $studentDoc = $this->firebase->getDocument('students', $uid);

        if (!isset($studentDoc['fields'])) {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }

        $fields = $studentDoc['fields'];
        $student = [
            'uid' => $fields['uid']['stringValue'] ?? null,
            'full_name' => $fields['full_name']['stringValue'] ?? null,
            'email' => $fields['email']['stringValue'] ?? null,
            'department' => $fields['department']['stringValue'] ?? null,
            'major' => $fields['major']['stringValue'] ?? null,
            'academic_year' => $fields['academic_year']['stringValue'] ?? null,
            'gpa' => $fields['gpa']['integerValue'] ?? null,
            'completed_courses' => json_decode($fields['completed_courses']['arrayValue']['values'] ?? '[]'),
            'registered_courses' => json_decode($fields['registered_courses']['arrayValue']['values'] ?? '[]'),
            'total_credit_hours' => $fields['total_credit_hours']['integerValue'] ?? null,
        ];

        return view('admin.students.show', ["user" => $student]);
    }

    // Show create form
    public function create()
    {
        return view('admin.students.create');
    }

    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'academic_year' => 'required|string|max:50',
            'gpa' => 'required|numeric|min:0|max:100',
            'total_credit_hours' => 'required|numeric|min:0',
            'completed_courses' => 'nullable|array',
            'registered_courses' => 'nullable|array',
        ]);

        $studentData = [
            'uid' => uniqid(), // generate UID if you don’t have Firebase Auth UID
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'department' => $validated['department'],
            'major' => $validated['major'],
            'academic_year' => $validated['academic_year'],
            'gpa' => (int)$validated['gpa'],
            'total_credit_hours' => (int)$validated['total_credit_hours'],
            'completed_courses' => $validated['completed_courses'] ?? [],
            'registered_courses' => $validated['registered_courses'] ?? [],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        $this->firebase->createDocument('students', $studentData);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    // Show edit form
    public function edit($uid)
    {
        $studentDoc = $this->firebase->getDocument('students', $uid);

        if (!isset($studentDoc['fields'])) {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }

        $fields = $studentDoc['fields'];
        $student = [
            'uid' => $fields['uid']['stringValue'] ?? null,
            'full_name' => $fields['full_name']['stringValue'] ?? null,
            'email' => $fields['email']['stringValue'] ?? null,
            'department' => $fields['department']['stringValue'] ?? null,
            'major' => $fields['major']['stringValue'] ?? null,
            'academic_year' => $fields['academic_year']['stringValue'] ?? null,
            'gpa' => $fields['gpa']['integerValue'] ?? null,
            'completed_courses' => json_decode($fields['completed_courses']['arrayValue']['values'] ?? '[]'),
            'registered_courses' => json_decode($fields['registered_courses']['arrayValue']['values'] ?? '[]'),
            'total_credit_hours' => $fields['total_credit_hours']['integerValue'] ?? null,
        ];

        return view('admin.students.edit', ['user' => $student]);
    }

    // Update student
    public function update(Request $request, $uid)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'academic_year' => 'required|string|max:50',
            'gpa' => 'required|numeric|min:0|max:100',
            'total_credit_hours' => 'required|numeric|min:0',
            'completed_courses' => 'nullable|array',
            'registered_courses' => 'nullable|array',
        ]);

        $studentData = [
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'department' => $validated['department'],
            'major' => $validated['major'],
            'academic_year' => $validated['academic_year'],
            'gpa' => (int)$validated['gpa'],
            'total_credit_hours' => (int)$validated['total_credit_hours'],
            'completed_courses' => $validated['completed_courses'] ?? [],
            'registered_courses' => $validated['registered_courses'] ?? [],
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        $this->firebase->updateDocument('students', $uid, $studentData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy($uid)
    {
        $this->firebase->deleteDocument('students', $uid);

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
