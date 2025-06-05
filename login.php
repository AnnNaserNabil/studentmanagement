<?php
session_start();
$loginMessage = isset($_SESSION['loginMessage']) ? $_SESSION['loginMessage'] : '';
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - Login</title>
    	<link rel="stylesheet" type="text/css" href="login.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
  
</head>
<body>
    <div class="form-container">
        <div class="text-center title">
            <h2>Login Form</h2>
            <?php if($loginMessage): ?>
                <div class="error-message"><?php echo $loginMessage; ?></div>
            <?php endif; ?>
        </div>
        
        <form action="login_check.php" method="POST">
        
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-submit">Login</button>
            </div>
        </form>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>