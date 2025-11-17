<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // General statistics
        $stats = [
            'enrolled' => 30,
            'successful' => 70,
            'failed' => 20,
            'graduated' => 40,
        ];

        // Bar chart data
        $barData = [
            ['Winter24', 5000],
            ['Summer24', 10000],
            ['Fall24', 15000],
            ['Winter25', 20000],
            ['Summer25', 25000],
            ['Fall25', 30000],
        ];

        // Donut chart data
        $donutData = [
            ['Excellent', 40],
            ['Good', 30],
            ['Needs Improvement', 30],
        ];

        // KPIs
        $kpis = [
            ['text' => 'Average GPA', 'number' => 3.4, 'progress' => 80, 'desc' => '↑ 5% from last semester', 'color' => 'primary', 'icon' => 'fas fa-chart-line'],
            ['text' => 'Retention Rate', 'number' => '88%', 'progress' => 88, 'desc' => '↑ 3% from 2024', 'color' => 'success', 'icon' => 'fas fa-user-check'],
            ['text' => 'Dropout Rate', 'number' => '6%', 'progress' => 60, 'desc' => '↓ 2% from 2024', 'color' => 'warning', 'icon' => 'fas fa-user-times'],
            ['text' => 'Top Department', 'number' => 'Computer Science', 'progress' => 90, 'desc' => 'Most enrolled students', 'color' => 'danger', 'icon' => 'fas fa-trophy'],
        ];

        // App engagement
        $engagement = [
            ['text' => 'Bookmarks On Tree', 'number' => 41410, 'progress' => 70, 'desc' => '70% Increase in 30 Days', 'color' => 'info', 'icon' => 'far fa-bookmark'],
            ['text' => 'Likes', 'number' => 41410, 'progress' => 70, 'desc' => '70% Increase in 30 Days', 'color' => 'success', 'icon' => 'far fa-thumbs-up'],
            ['text' => 'Events', 'number' => 41410, 'progress' => 70, 'desc' => '70% Increase in 30 Days', 'color' => 'warning', 'icon' => 'far fa-calendar-alt'],
            ['text' => 'Chats With Chatbot', 'number' => 41410, 'progress' => 70, 'desc' => '70% Increase in 30 Days', 'color' => 'danger', 'icon' => 'fas fa-comments'],
        ];

        // Most active users
        $activeUsers = [
            ['name' => 'Ahmad Khaled', 'interactions' => 254, 'lastActive' => 'Today'],
            ['name' => 'Rana Salem', 'interactions' => 230, 'lastActive' => '1 day ago'],
            ['name' => 'Omar Alzoubi', 'interactions' => 218, 'lastActive' => '2 days ago'],
        ];

        // Upcoming events
        $events = [
            'AI Workshop – 10 Nov 2025',
            'Career Fair – 15 Nov 2025',
            'Data Science Bootcamp – 20 Nov 2025',
        ];

        // Students
        $students = [
            ['id'=>1,'name'=>'Ahmad Khaled','email'=>'ahmad@gmail.com','role'=>'student'],
            ['id'=>2,'name'=>'Rana Salem','email'=>'rana@gmail.com','role'=>'student'],
            ['id'=>3,'name'=>'Omar Alzoubi','email'=>'omar@gmail.com','role'=>'student'],
        ];
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // --- Key Performance Indicators (KPIs) ---
        $kpis = [
            [
                'title' => 'Average GPA',
                'value' => 3.4,
                'progress' => 80,
                'description' => '↑ 5% from last semester',
                'bg' => 'primary',
                'icon' => 'fas fa-chart-line'
            ],
            [
                'title' => 'Retention Rate',
                'value' => '88%',
                'progress' => 88,
                'description' => '↑ 3% from 2024',
                'bg' => 'success',
                'icon' => 'fas fa-user-check'
            ],
            [
                'title' => 'Dropout Rate',
                'value' => '6%',
                'progress' => 60,
                'description' => '↓ 2% from 2024',
                'bg' => 'warning',
                'icon' => 'fas fa-user-times'
            ],
            [
                'title' => 'Top Department',
                'value' => 'Computer Science',
                'progress' => 90,
                'description' => 'Most enrolled students',
                'bg' => 'danger',
                'icon' => 'fas fa-trophy'
            ],
        ];

        // --- Bar Chart: Enrolled Students Last 2 Years ---
        $barChartData = [
            [1, 5000],
            [2, 10000],
            [3, 15000],
            [4, 20000],
            [5, 25000],
            [6, 30000]
        ];

        $barChartLabels = ['Winter24','Summer24','Fall24','Winter25','Summer25','Fall25'];

        // --- Donut Chart: Students Ranks ---
        $donutChartData = [
            ['label' => 'Excellent', 'data' => 40, 'color' => '#005040ff'],
            ['label' => 'Good', 'data' => 30, 'color' => '#808b41ff'],
            ['label' => 'Needs Improvement', 'data' => 30, 'color' => '#3c8dbc']
        ];

        // --- App Engagement / Activities ---
        $appEngagement = [
            [
                'title' => 'Bookmarks On Tree',
                'value' => '41,410',
                'progress' => 70,
                'description' => '70% Increase in 30 Days',
                'bg' => 'info',
                'icon' => 'far fa-bookmark'
            ],
            [
                'title' => 'Likes',
                'value' => '41,410',
                'progress' => 70,
                'description' => '70% Increase in 30 Days',
                'bg' => 'success',
                'icon' => 'far fa-thumbs-up'
            ],
            [
                'title' => 'Events',
                'value' => '41,410',
                'progress' => 70,
                'description' => '70% Increase in 30 Days',
                'bg' => 'warning',
                'icon' => 'far fa-calendar-alt'
            ],
            [
                'title' => 'Chats With Chatbot',
                'value' => '41,410',
                'progress' => 70,
                'description' => '70% Increase in 30 Days',
                'bg' => 'danger',
                'icon' => 'fas fa-comments'
            ],
        ];

        // --- Students Data ---
        $students = [
            ['id'=>1, 'name'=>'Ahmad Khaled', 'email'=>'ahmad@example.com', 'role'=>'student', 'gpa'=>3.7, 'enrolled_courses'=>5],
            ['id'=>2, 'name'=>'Rana Salem', 'email'=>'rana@example.com', 'role'=>'student', 'gpa'=>3.4, 'enrolled_courses'=>3],
            ['id'=>3, 'name'=>'Omar Alzoubi', 'email'=>'omar@example.com', 'role'=>'student', 'gpa'=>3.2, 'enrolled_courses'=>4],
        ];

        // --- Admins Data (No actions allowed) ---
        $admins = [
            ['id'=>1, 'name'=>'Islam Almshamsheh', 'email'=>'islam@example.com', 'role'=>'admin'],
            ['id'=>2, 'name'=>'John Doe', 'email'=>'john@example.com', 'role'=>'admin'],
        ];

        // --- Return all data to the view ---
        return view('admin.statistics', compact(
            'kpis',
            'barChartData',
            'barChartLabels',
            'donutChartData',
            'appEngagement',
            'students',
            'admins'
        ));
    }
}

        // Admins
        $admins = [
            ['id'=>1,'name'=>'Islam Admin','email'=>'islam@admin.com','role'=>'admin'],
            ['id'=>2,'name'=>'Admin Two','email'=>'admin2@admin.com','role'=>'admin'],
        ];

        return view('admin.dashboard', compact('stats','barData','donutData','kpis','engagement','activeUsers','events','students','admins'));
    }
}
