<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign In</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg,rgb(41, 129, 216), #e3e3e3);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .form-signin {
        width: 100%;
        max-width: 360px;
        padding: 2rem;
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      }
      .btn-primary {
        --bs-btn-bg: #6366f1;
        --bs-btn-hover-bg: #4338ca;
        --bs-btn-focus-shadow-rgb: 99, 102, 241;
        font-weight: 600;
        margin-bottom: 20px;
      }
      .btn-primary:disabled {
        opacity: 0.5;
      }
    </style>
  </head>
  <body>
    <main class="form-signin text-center">
      @if (request()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @if (request('error') === 'incorrect_password')
            Incorrect password.
          @elseif (request('error') === 'username_not_found')
            Username not found.
          @else
            Something went wrong. Please try again.
          @endif
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        
      <form method="POST" action="/login">
        <h1 class="h3 mb-4 fw-semibold">Log in</h1>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Email" required/>
          <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
          <label for="password">Password</label>
        </div>
        <div class="form-check text-start mb-3">
          <input
            class="form-check-input"
            type="checkbox"
            value="remember-me"
            id="rememberMe"
          />
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">
          Sign in
        </button>
        <a href="/register" class="register-link" id="register-link">Create an account</a>
      </form>
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
