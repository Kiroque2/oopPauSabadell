<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0044cc;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #0044cc;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background: #0044cc;
            color: white;
            margin: 0.5rem 0;
            padding: 0.5rem;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        ul li:hover {
            transform: scale(1.05);
        }

        form {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form input[type="number"],
        form input {
            padding: 0.5rem;
            width: 100%;
            max-width: 400px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 0.5rem 1rem;
            background-color: #0044cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #002a80;
        }

        .message {
            margin: 1rem 0;
            padding: 1rem;
            background-color: #e0ffe0;
            color: #006600;
            border: 1px solid #00cc00;
            border-radius: 5px;
        }

        .message.error {
            background-color: #ffe0e0;
            color: #cc0000;
            border-color: #cc0000;
        }
    </style>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
    </header>
    <main>
        <h2>Students List</h2>
        <ul>
            <?php foreach ($students as $student): ?>
                <li>
                    <?= htmlspecialchars($student['first_name'], ENT_QUOTES, 'UTF-8'); ?> <?= htmlspecialchars($student['last_name'], ENT_QUOTES, 'UTF-8'); ?> - 
                    <?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?> 
                    <a href="/student/delete/<?= $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (isset($message)): ?>
            <div class="message <?= $error ? 'error' : '' ?>">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <h3>Create New Student</h3>
        <form method="POST" action="/student">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" id="user_id" required>

            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" required>

            <label for="enrollment_year">Enrollment Year</label>
            <input type="number" name="enrollment_year" id="enrollment_year" required>

            <button type="submit">Create Student</button>
        </form>
    </main>
</body>
</html>
