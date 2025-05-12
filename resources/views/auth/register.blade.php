<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(135deg,rgb(41, 129, 216), #e3e3e3);
        height: 100vh;
        align-items: center;
        justify-content: center;
      }

      .form-register {
        max-width: 500px;
        margin: auto;
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <main class="form-register">
      <h2 class="mb-4 text-center">Registration Form</h2>
      <form id="registrationForm" action="/register" method="POST">
        <div class="mb-3">
          <label for="id" class="form-label" hidden>ID</label>
          <input type="text" class="form-control" id="id" name="id" disabled hidden>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Position</label>
            <select class="form-select" required name="position">
              <option value="">Select Position</option>
              <option value="Admin">Admin</option>
              <option value="IT">IT</option>
              <option value="Staff">Staff</option>
              <option value="Accountant">Accountant</option>
            </select>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
