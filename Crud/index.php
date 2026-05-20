<?php
    session_start();
    require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Dashboard Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Student Portal - Dashboard</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F4F2F9; 
            color: #2D3748;
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: #8749f5;
            color: white;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            border-radius: 0 30px 30px 0;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(135, 73, 245, 0.15);
        }
        .sidebar-logo { text-align: center; margin-bottom: 2.5rem; }
        .sidebar-logo .icon-box {
            background: white; color: #8749f5;
            width: 60px; height: 60px;
            border-radius: 18px; display: inline-flex;
            align-items: center; justify-content: center;
            font-size: 28px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .sidebar a {
            color: rgba(255,255,255,0.7); text-decoration: none;
            padding: 14px 20px; border-radius: 14px;
            margin-bottom: 8px; display: flex; align-items: center;
            font-weight: 500; transition: all 0.3s ease;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.15); color: white;
            transform: translateX(5px);
        }
        .sidebar a span { margin-right: 15px; font-size: 1.1rem; width: 25px; text-align: center; }

        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
            padding: 2rem 3rem;
            min-height: 100vh;
        }
        .top-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 2rem; background: white;
            padding: 1rem 2rem; border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .search-bar input {
            border: none; background: #F4F2F9; border-radius: 20px;
            padding: 10px 25px; width: 350px; outline: none; font-size: 14px;
        }
        .search-bar input:focus { box-shadow: 0 0 0 2px rgba(135, 73, 245, 0.3); background: white; }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, #8749f5 0%, #6d28d9 100%);
            border-radius: 24px; padding: 2.5rem 3rem;
            box-shadow: 0 10px 25px rgba(135, 73, 245, 0.25);
            margin-bottom: 2rem; color: white;
            display: flex; justify-content: space-between; align-items: center;
        }
        
        /* Cards */
        .card {
            border: none; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); background: white;
            overflow: hidden;
        }
        .card-header {
            background: transparent; border-bottom: 1px solid #F0F0F0;
            padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center;
        }
        .card-header h4 { margin: 0; font-weight: 700; color: #2D3748; font-size: 1.25rem; width: 100%; display: flex; justify-content: space-between; align-items: center;}
        .card-body { padding: 2rem; }

        /* Tables */
        .table { border-collapse: separate; border-spacing: 0 10px; margin-top: -10px; }
        .table thead th {
            border-bottom: none; color: #A0AEC0; font-weight: 600;
            text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;
            padding: 0 1.5rem 0.5rem 1.5rem;
        }
        .table tbody tr { background: #F8F9FA; box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: 0.2s; }
        .table tbody tr:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.06); }
        .table tbody td {
            border: none; padding: 1.2rem 1.5rem; vertical-align: middle;
            color: #4A5568; font-weight: 500; font-size: 0.95rem;
        }
        .table tbody td:first-child { border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
        .table tbody td:last-child { border-top-right-radius: 16px; border-bottom-right-radius: 16px; }

        /* Buttons */
        .btn { border-radius: 12px; padding: 8px 16px; font-weight: 600; font-size: 0.9rem; transition: 0.3s; }
        .btn-primary { background: #8749f5; border: none; }
        .btn-primary:hover { background: #6d28d9; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(135, 73, 245, 0.3); }
        .btn-sm { border-radius: 8px; padding: 6px 12px; font-size: 0.8rem; margin-right: 5px; }
        .btn-info { background: #38bdf8; border: none; color: white !important; }
        .btn-success { background: #10b981; border: none; color: white !important; }
        .btn-danger { background: #ef4444; border: none; color: white !important; }
    </style>
  </head>
  <body>
  
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="icon-box">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h5 class="text-white mt-3 fw-bold">Student Portal</h5>
        </div>
        <a href="index.php" class="active"><span><i class="fas fa-th-large"></i></span> Dashboard</a>
        <a href="index.php"><span><i class="fas fa-users"></i></span> Members</a>
        <a href="student-create.php"><span><i class="fas fa-user-plus"></i></span> Add Student</a>
        <a href="#"><span><i class="fas fa-book"></i></span> Courses</a>
        <a href="#" class="mt-auto"><span><i class="fas fa-sign-out-alt"></i></span> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        
        <!-- Top Header -->
        <div class="top-header">
            <div class="search-bar">
                <input type="text" placeholder="Search students, courses...">
            </div>
            <div class="user-profile d-flex align-items-center">
                <div class="text-end me-3 d-none d-md-block">
                    <h6 class="mb-0 fw-bold">Admin User</h6>
                    <small class="text-muted">Administrator</small>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=8749f5&color=fff" class="rounded-circle" width="45" alt="Profile">
            </div>
        </div>

        <?php include('message.php'); ?>

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <p class="text-white-50 mb-1"><?= date('F j, Y'); ?></p>
                <h2 class="text-white fw-bold mb-1">Welcome back, Admin!</h2>
                <p class="text-white-50 mb-0">Always stay updated in your student portal</p>
            </div>
            <div>
                <i class="fas fa-award fa-4x text-white opacity-75"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                            <a href="student-create.php" class="btn btn-primary float-end"><i class="fas fa-plus me-1"></i> Add Students</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><b>#<?= $student['id']; ?></b></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-weight: bold;">
                                                            <?= strtoupper(substr($student['name'], 0, 1)); ?>
                                                        </div>
                                                        <?= $student['name']; ?>
                                                    </div>
                                                </td>
                                                <td><?= $student['email']; ?></td>
                                                <td><?= $student['phone']; ?></td>
                                                <td><span class="badge" style="background: #e9d5ff; padding: 6px 12px; border-radius: 8px; font-weight: 600; color: #6b21a8 !important;"><?= $student['course']; ?></span></td>
                                                <td>
                                                    <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="student-edit.php?id=<?= $student['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_student" value="<?=$student['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr><td colspan='6' class='text-center py-4'><h5> No Record Found </h5></td></tr>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>