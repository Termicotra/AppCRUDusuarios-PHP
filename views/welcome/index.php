<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php?error=Acceso no autorizado");
    exit;
}

$username = $_SESSION['username'];
$token = $_SESSION['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Bienvenido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand" href="#">AppCRUDLoginUsuarios</a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-person fs-3 me-2"></i>
        <span class="fw-bold"><?= htmlspecialchars($username) ?></span>
      </div>
      <a href="/TP_Final/controllers/logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
    </div>
  </nav>

  <div class="container py-5">
    <h1 class="mb-4 text-center">Bienvenido, <?= htmlspecialchars($username) ?> 👋</h1>

    <?php if ($username === 'admin'): ?>
      <div class="mb-4">
        <p class="lead text-center">Panel de administración de usuarios</p>

        <!-- 🔍 Ver usuarios -->
        <div class="text-center mb-3">
          <button id="getUsuarios" class="btn btn-primary">📄 Ver todos los usuarios</button>
        </div>

        <!-- ➕ Crear usuario -->
        <form id="formCrear" class="mb-4">
          <h5>Crear usuario</h5>
          <input type="text" class="form-control mb-2" id="crearUsername" placeholder="Nombre de usuario" required>
          <input type="password" class="form-control mb-2" id="crearPassword" placeholder="Contraseña" required>
          <button type="submit" class="btn btn-success">Crear</button>
        </form>

        <!-- ✏️ Actualizar usuario -->
        <form id="formActualizar" class="mb-4">
          <h5>Actualizar usuario</h5>
          <input type="number" class="form-control mb-2" id="actualizarId" placeholder="ID del usuario" required>
          <input type="text" class="form-control mb-2" id="actualizarUsername" placeholder="Nuevo nombre de usuario" required>
          <input type="password" class="form-control mb-2" id="actualizarPassword" placeholder="Nueva contraseña" required>
          <button type="submit" class="btn btn-warning">Actualizar</button>
        </form>

        <!-- 🗑️ Eliminar usuario -->
        <form id="formEliminar" class="mb-4">
          <h5>Eliminar usuario</h5>
          <input type="number" class="form-control mb-2" id="eliminarId" placeholder="ID del usuario" required>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>

        <!-- Resultado -->
        <pre id="resultado" class="bg-white p-3 border rounded"></pre>
      </div>
    <?php else: ?>
      <p class="lead text-center">Tu sesión está activa. No tenés permisos de administrador.</p>
    <?php endif; ?>
  </div>

  <?php if ($username === 'admin'): ?>
  <script>
    const token = "<?= $token ?>";

    // Ver usuarios
    document.getElementById("getUsuarios").addEventListener("click", () => {
      fetch("http://localhost/TP_Final/api/usuarios/index.php", {
        method: "GET",
        headers: { "Authorization": token }
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("resultado").textContent = JSON.stringify(data, null, 2);
      });
    });

    // Crear usuario
    document.getElementById("formCrear").addEventListener("submit", (e) => {
      e.preventDefault();
      const username = document.getElementById("crearUsername").value;
      const password = document.getElementById("crearPassword").value;

      fetch("http://localhost/TP_Final/api/usuarios/create.php", {
        method: "POST",
        headers: {
          "Authorization": token,
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ username, password })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("resultado").textContent = JSON.stringify(data, null, 2);
      });
    });

    // Actualizar usuario
    document.getElementById("formActualizar").addEventListener("submit", (e) => {
      e.preventDefault();
      const id = document.getElementById("actualizarId").value;
      const username = document.getElementById("actualizarUsername").value;
      const password = document.getElementById("actualizarPassword").value;

      fetch(`http://localhost/TP_Final/api/usuarios/update.php?id=${id}`, {
        method: "PUT",
        headers: {
          "Authorization": token,
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ username, password })
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("resultado").textContent = JSON.stringify(data, null, 2);
      });
    });

    // Eliminar usuario
    document.getElementById("formEliminar").addEventListener("submit", (e) => {
      e.preventDefault();
      const id = document.getElementById("eliminarId").value;

      fetch(`http://localhost/TP_Final/api/usuarios/delete.php?id=${id}`, {
        method: "DELETE",
        headers: { "Authorization": token }
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("resultado").textContent = JSON.stringify(data, null, 2);
      });
    });
  </script>
  <?php endif; ?>

</body>
</html>