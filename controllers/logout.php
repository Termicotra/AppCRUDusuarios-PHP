<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Views/login/index.php?success=Sesión cerrada correctamente");
exit;