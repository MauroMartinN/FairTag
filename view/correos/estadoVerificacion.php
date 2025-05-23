<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de Correo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }

        .success {
            color: #2ecc71;
            font-size: 1.4em;
            margin-bottom: 20px;
        }

        .error {
            color: #e74c3c;
            font-size: 1.4em;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if ($estadoVerificacion): ?>
            <div class="icon">✅</div>
            <div class="success">¡Tu correo ha sido verificado con éxito!</div>
            <a href="index.php">Ir al inicio</a>
        <?php else: ?>
            <div class="icon">❌</div>
            <div class="error">El token no es válido o ya fue utilizado.</div>
            <a href="index.php">Volver al inicio</a>
        <?php endif; ?>
    </div>
</body>
</html>
