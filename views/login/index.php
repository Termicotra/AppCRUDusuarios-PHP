<!doctype html>
<html lang="es" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Federico Traversi" />
    <meta name="generator" content="Astro v5.13.2" />
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/" />
    <script src="../assets/js/color-modes.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="../assets/sign-in.css" rel="stylesheet" />
    <style>
      .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
      }
      .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
      }
      footer {
        background-color: #f8f9fa;
        padding: 1rem 0;
        text-align: center;
        font-size: 0.9rem;
        color: #6c757d;
      }
    </style>
  </head>
  <body class="bg-body-tertiary">

    <!-- Navbar personalizado -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
      <a class="navbar-brand" href="#">AppCRUDLoginUsuarios</a>
      <div class="ms-auto user-info">
        <img src="../assets/img/federico.png" />
        <span>Federico Traversi</span>
      </div>
    </nav>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center w-100" role="alert">
        Datos incorrectos
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success text-center w-100" role="alert">
        <?= htmlspecialchars($_GET['success']) ?>
      </div>
    <?php endif; ?>

    <main class="form-signin w-100 m-auto py-5">
      <form action="<?= '/TP_Final/controllers/login.php' ?>" method="POST">
        <h1 class="h3 mb-3 fw-normal">Inicie Sesion</h1>

        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            name="username"
            placeholder="Username"
            required
          />
          <label for="floatingInput">Username</label>
        </div>

        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            name="password"
            placeholder="Password"
            required
          />
          <label for="floatingPassword">Password</label>
        </div>

        

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
      </form>
    </main>

    <!-- Footer personalizado -->
    <footer>
      Ingeniería en Informática – SPD – © <span id="year"></span>
    </footer>

    <script>
      document.getElementById("year").textContent = new Date().getFullYear();
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>