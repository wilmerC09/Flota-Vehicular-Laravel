<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página No Encontrada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .error-image {
            max-width: 600px;
            width: 100%;
            height: auto;
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .error-content h1 {
            font-size: 42px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .error-content p {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 35px;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .back-home {
            display: inline-block;
            padding: 14px 40px;
            background: #10b981;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        .back-home:hover {
            background: #059669;
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .error-image {
                max-width: 400px;
            }

            .error-content h1 {
                font-size: 32px;
            }

            .error-content p {
                font-size: 16px;
                padding: 0 20px;
            }

            .back-home {
                font-size: 14px;
                padding: 12px 30px;
            }
        }

        @media (max-width: 480px) {
            .error-image {
                max-width: 300px;
            }

            .error-content h1 {
                font-size: 26px;
            }

            .error-content p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('images/404-image.png') }}" alt="404 Error" class="error-image">

        <div class="error-content">
            <h1>¡Oops! Página no encontrada.</h1>
            <p>O simplemente aprovecha la experiencia de nuestro equipo de consultoría.</p>
            <a href="{{ url('/') }}" class="back-home">Ir al Inicio</a>
        </div>
    </div>
</body>

</html>