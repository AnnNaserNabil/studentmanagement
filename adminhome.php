<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="adminhome.css">
    
</head>
<body>
    <!-- Header -->
    <header class="header">
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <a href="#" class="logo">
            <i class="bi bi-speedometer2"></i>
            Admin Home
        </a>
        <div class="user-menu">
            <span class="me-3">Welcome, Admin</span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <ul>
            <li>
                <a href="#" class="active">
                    <i class="bi bi-house-door"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="admission.php">
                    <i class="bi bi-person-plus"></i>
                    Admission
                </a>
            </li>
            <li>
                <a href="Add_Student.php">
                    <i class="bi bi-person-add"></i>
                    Add Student
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-people"></i>
                    View Students
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-person-badge"></i>
                    Add Teacher
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-person-lines-fill"></i>
                    View Teachers
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-book-half"></i>
                    Add Courses
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-journal-bookmark"></i>
                    View Courses
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="content-header fade-in">
            <h1>Dashboard Overview</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </nav>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-cards fade-in">
            <div class="dashboard-card">
                <i class="bi bi-people-fill"></i>
                <h3>Total Students</h3>
                <p>Manage student records and enrollment</p>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-person-workspace"></i>
                <h3>Teachers</h3>
                <p>Manage teaching staff and assignments</p>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-book-fill"></i>
                <h3>Courses</h3>
                <p>Manage course catalog and schedules</p>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-graph-up"></i>
                <h3>Analytics</h3>
                <p>View performance metrics and reports</p>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section fade-in">
            <h3 class="mb-3">Quick Search</h3>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" class="form-control search-input" placeholder="Search students, teachers, or courses..." id="searchInput">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100" onclick="performSearch()">
                        <i class="bi bi-search me-2"></i>
                        Search
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    
</body>
</html>