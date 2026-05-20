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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Student Edit</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Poppins', sans-serif; background-color: #F4F2F9; color: #2D3748; margin: 0; overflow-x: hidden;}

        /* Sidebar Styling */
        .sidebar {
            width: 260px; background: #8749f5; color: white;
            padding: 2rem 1.5rem; display: flex; flex-direction: column;
            border-radius: 0 30px 30px 0; position: fixed; height: 100vh;
            top: 0; left: 0; z-index: 100; box-shadow: 4px 0 20px rgba(135, 73, 245, 0.15);
        }
        .sidebar-logo { text-align: center; margin-bottom: 2.5rem; }
        .sidebar-logo .icon-box {
            background: white; color: #8749f5; width: 60px; height: 60px;
            border-radius: 18px; display: inline-flex; align-items: center; justify-content: center;
            font-size: 28px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .sidebar a {
            color: rgba(255,255,255,0.7); text-decoration: none; padding: 14px 20px; border-radius: 14px; margin-bottom: 8px; 
            display: flex; align-items: center; font-weight: 500; transition: all 0.3s ease;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); color: white; transform: translateX(5px); }
        .sidebar a span { margin-right: 15px; font-size: 1.1rem; width: 25px; text-align: center; }

        /* Main Content */
        .main-wrapper { margin-left: 260px; padding: 2rem 3rem; min-height: 100vh; }
        .top-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 2rem; background: white; padding: 1rem 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        
        /* Cards */
        .card { border: none; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); background: white; }
        .card-header { background: transparent; border-bottom: 1px solid #F0F0F0; padding: 1.5rem 2rem; }
        .card-header h4 { margin: 0; font-weight: 700; color: #2D3748; font-size: 1.25rem; display: flex; justify-content: space-between; align-items: center;}
        .card-body { padding: 2rem 3rem; }

        /* Forms */
        .form-control { border-radius: 12px; padding: 12px 18px; border: 1px solid #E2E8F0; background: #F8F9FA; font-weight: 500; }
        .form-control:focus { border-color: #8749f5; box-shadow: 0 0 0 3px rgba(135, 73, 245, 0.15); background: white; }
        label { font-weight: 600; color: #4A5568; margin-bottom: 8px; font-size: 0.9rem; }

        /* Buttons */
        .btn { border-radius: 12px; padding: 10px 20px; font-weight: 600; font-size: 0.95rem; transition: 0.3s; }
        .btn-primary { background: #8749f5; border: none; }
        .btn-primary:hover { background: #6d28d9; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(135, 73, 245, 0.3); }
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
        <a href="index.php"><span><i class="fas fa-th-large"></i></span> Dashboard</a>
        <a href="index.php"><span><i class="fas fa-users"></i></span> Members</a>
        <a href="student-create.php"><span><i class="fas fa-user-plus"></i></span> Add Student</a>
        <a href="#"><span><i class="fas fa-book"></i></span> Courses</a>
        <a href="#" class="mt-auto"><span><i class="fas fa-sign-out-alt"></i></span> Logout</a>
    </div>

    <div class="main-wrapper">
        <div class="top-header">
            <h5 class="mb-0 fw-bold text-muted">Update Information</h5>
        </div>

        <?php include('message.php'); ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="index.php" class="btn btn-danger float-end"><i class="fas fa-arrow-left me-1"></i> BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-4">
                                        <label>Student Name</label>
                                        <input type="text" name="name" value="<?=$student['name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label>Student Email</label>
                                        <input type="email" name="email" value="<?=$student['email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label>Student Phone</label>
                                        <input type="text" name="phone" value="<?=$student['phone'];?>" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label>Student Course</label>
                                        <input type="text" name="course" value="<?=$student['course'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3 mt-4 text-end">
                                        <button type="submit" name="update_student" class="btn btn-primary px-5">
                                            Update Student
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>