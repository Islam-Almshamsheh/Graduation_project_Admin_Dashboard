<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" 
             alt="AdminLTE Logo" 
             class="brand-image img-circle elevation-3" 
             style="opacity: .8">
        <span class="brand-text font-weight-light">UniGuide</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" 
                     class="img-circle elevation-2" 
                     alt="User Image">
            </div>
            <div class="info">
                @if(session('admin'))
                    <a href="#" class="d-block">
                        {{ session('admin.name') }}
                    </a>
                @else
                    <a href="#" class="d-block">Guest</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Search -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @if(session('admin'))
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" 
                data-widget="treeview" 
                role="menu" 
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route( 'admin.dashboard') }}"
                               class="nav-link">
                                <i class="fas fa-user-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.statistics') }}"
                               class="nav-link">
                                <i class="fas fa-chart-line nav-icon"></i>
                                <p>Statistics</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    <!-- Students Management -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Students Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('students.index') }}" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>All Students</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('students.create') }}" class="nav-link">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Create Student</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Categories Management -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>
                                Categories Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Events Management -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Events Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link">
                                    <i class="fas fa-calendar nav-icon"></i>
                                    <p>All Events</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.posts.create') }}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create Event</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Tags Management -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Tags Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tags.index') }}" class="nav-link">
                                    <i class="fas fa-list-alt nav-icon"></i>
                                    <p>All Tags</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('tags.create') }}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Create Tag</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <!-- USER SECTION -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                My Posts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        @endif
    </div>
</aside>
