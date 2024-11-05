<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../views/partials/head.php'; ?>
    <title>Public Notes</title>
</head>
<body class="bg-gray-100">
    <?php include __DIR__ . '/../views/partials/nav.php'; ?>

    <main class="container mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Public Notes</h1>
        <?php if (!empty($notes)): ?>
            <ul class="space-y-4">
                <?php foreach ($notes as $note): ?>
                    <li class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">From : <?= htmlspecialchars($note['email']) ?></h2>
                        <h3 class="text-l font-semibold"><?= htmlspecialchars($note['title']) ?></h3>
                        <p class="text-gray-600"><?= htmlspecialchars($note['content']) ?></p>
                        <small class="text-gray-500">Created at: <?= htmlspecialchars($note['created_at']) ?> </small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">No public notes available.</p>
        <?php endif; ?>
    </main>
</body>
</html>
