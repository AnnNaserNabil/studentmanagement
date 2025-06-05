<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<link rel="stylesheet" href="Admin_dashboard.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
    
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-graduation-cap"></i> University Admin</h2>
        </div>
        <ul class="sidebar-nav">
            <li>
                <a href="#" class="nav-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="about.php" class="nav-item">
                    <i class="fas fa-user-plus"></i>
                    About
                </a>
            </li>
            <li>
                <a href="admission.php" class="nav-item">
                    <i class="fas fa-user-graduate"></i>
                  Admission
                </a>
            </li>
            <li>
                <a href="Academic.php" class="nav-item">
                    <i class="fas fa-users"></i>
                   Academics
                </a>
            </li>
            <li>
                <a href="center.php" class="nav-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Center
                </a>
            </li>
            <li>
                <a href="#" class="nav-item">
                    <i class="fas fa-clipboard-list"></i>
                   Offices
                </a>
            </li>
            <li>
                <a href="#" class="nav-item">
                    <i class="fas fa-book"></i>
                    Journals
                </a>
            </li>
            <li>
                <a href="#" class="nav-item">
                    <i class="fas fa-book-open"></i>
                    Research
                </a>
            </li>
        </ul>
    </nav>

    <!-- Topbar -->
    <nav class="topbar">
        <button class="toggle-sidebar">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="search-bar d-none d-md-flex">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        
        <div class="d-flex align-items-center">
            <div class="position-relative">
                <a href="#" class="btn btn-link position-relative">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        1+
                    </span>
                </a>
            </div>
            
            <div class="topbar-divider"></div>
            
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-info">
                        <p class="user-name">Latest Notice</p>
                        <p class="user-role">Administrator</p>
                    </div>
                    <img class="user-img" src="/api/placeholder/40/40" alt="Profile">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Activity Log</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

  
    <div class="content-wrapper">
        <div class="content">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h1>Dashboard</h1>
                <button class="btn btn-primary">
                    <i class="fas fa-download fa-sm"></i> Generate Report
                </button>
            </div>
            
            
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                      <div class="card-body">
                      <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Total Students</div>
                           <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                             <div class="col-auto">
                       <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                         </div>
                     </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success h-100 py-2">
                        <div class="card-body">
                         <div class="row no-gutters align-items-center">
                             <div class="col mr-2">
                                 <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Teachers</div>
                                 <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Courses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Example Form Card -->
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email address">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob">
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender">
                                    <option selected disabled>Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" placeholder="Enter complete address"></textarea>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-select" id="course">
                                    <option selected disabled>Select course</option>
                                    <option>Computer Science</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Chemistry</option>
                                    <option>Biology</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="batch" class="form-label">Batch Year</label>
                                <select class="form-select" id="batch">
                                    <option selected disabled>Select batch year</option>
                                    <option>2025</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input class="form-control" type="file" id="photo">
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="text-muted">All Rights Reserved. Design, Development and Maintenance by ICT Cell and Aerolith Solution &copy;  Admin Dashboard 2025</div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle sidebar on mobile
        const toggleBtn = document.querySelector('.toggle-sidebar');
        const sidebar = document.querySelector('.sidebar');
        const body = document.body;
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                body.classList.toggle('sidebar-open');
            });
        }
        
        // Add active class to nav items on click
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    </script>
</body>
</html>
