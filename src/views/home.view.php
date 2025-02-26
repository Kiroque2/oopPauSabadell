<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School - <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        /* Estilos globales */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Estilos del encabezado */
        header {
            background: linear-gradient(90deg, #0044cc, #002a80);
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        /* Estilos de la navegación */
        nav {
            margin-top: 1rem;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        nav li {
            margin: 0;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Contenido principal */
        main {
            padding: 2rem;
            text-align: center;
        }

        main h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: #0044cc;
        }

        main p {
            font-size: 1.2rem;
            color: #555;
        }

        /* Estilos del pie de página */
        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #0044cc;
            color: #fff;
            margin-top: 2rem;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
            font-size: 1rem;
        }

        footer a {
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h1>
        <nav>
            <ul>
                <?php if (isset($entities) && is_array($entities)): ?>
                    <?php foreach ($entities as $entityName => $entityPath): ?>
                        <li><a href="<?= htmlspecialchars($entityPath, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($entityName, ENT_QUOTES, 'UTF-8') ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No entities available.</li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Discover <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p>Your gateway to explore our school’s resources and departments. Click on the menu above to navigate through our offerings.</p>
    </main>
    <footer>
        <p>&copy; <?= date('Y'); ?> <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>. Powered by <a href="#">Your Organization</a>.</p>
    </footer>
</body>
</html>
