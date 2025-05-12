<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finance.App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg,rgb(41, 129, 216), #e3e3e3);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .cover {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cover h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .cover p {
            font-size: 1.25rem;
            color: #666;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Finance.App</a>
        <div class="d-flex">
            <a href="/login" class="btn btn-outline-primary me-2">Login</a>
            <a href="/register" class="btn btn-primary">Register</a>
        </div>
    </div>
</nav>

<!-- Cover Section -->
<div class="cover">
    <div>
        <h1>Welcome to Finance.App</h1>
        <p>Take control of your spending, savings, and goals — all in one powerful, easy-to-use finance app.</p>
        <h6>A simple user management console by vahn.</h6>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
