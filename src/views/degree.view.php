<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

    <!-- Mostrar los grados existentes -->
    <ul>
        <?php foreach ($degrees as $degree): ?>
            <li><?= htmlspecialchars($degree['name'], ENT_QUOTES, 'UTF-8'); ?> (Duration: <?= htmlspecialchars($degree['duration_years'], ENT_QUOTES, 'UTF-8'); ?> years)</li>
        <?php endforeach; ?>
    </ul>

    <!-- Formulario para crear un nuevo grado -->
    <h2>Create New Degree</h2>
    <form action="/degree" method="POST">
        <label for="name">Degree Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="duration_years">Duration (in years):</label>
        <input type="number" name="duration_years" id="duration_years" required><br><br>

        <button type="submit">Create Degree</button>
    </form>

    <?php if (isset($message)): ?>
        <div class="message <?= $error ? 'error' : 'success'; ?>">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
</body>
</html>
