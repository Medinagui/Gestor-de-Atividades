<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: principal.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Resto do cabeçalho -->
</head>
<body>
    <!-- Resto do corpo da página -->
</body>
</html>
