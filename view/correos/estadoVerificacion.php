<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificación de Correo</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background:  #8fd19e;
            background-size: 400% 400%;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .verificacion-container {
            max-width: 420px;
            margin: 50px auto;
            padding: 35px 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .verificacion-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .verificacion-mensaje {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .verificacion-success {
            color: #28a745;
        }

        .verificacion-error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="verificacion-container">
        <?php if ($estadoVerificacion): ?>
            <div class="verificacion-icon">✅</div>
            <div class="verificacion-mensaje verificacion-success">¡Tu correo ha sido verificado con éxito!</div>
            <div>Puedes cerrar esta pestaña</div>
        <?php else: ?>
            <div class="verificacion-icon">❌</div>
            <div class="verificacion-mensaje verificacion-error">El token no es válido o ya fue utilizado.</div>
            <div>Puedes cerrar esta pestaña</div>
        <?php endif; ?>
    </div>
</body>

</html>