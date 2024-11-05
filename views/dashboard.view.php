<?php require __DIR__ . '/partials/head.php'; ?>
<?php require __DIR__ . '/partials/nav.php'; ?>

<div class="container mx-auto p-6">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Notes</h1>
        
    </header>

    <main>
        <?php if (!empty($notes)): ?>
            <ul class="space-y-4">
                <?php foreach ($notes as $note): ?>
                    <li class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($note['title']) ?></h2>
                        <p class="mt-2 text-gray-700"><?= htmlspecialchars($note['content']) ?></p>
                        <small class="block mt-4 text-gray-500">Created at: <?= $note['created_at'] ?></small>
                        <div class="mt-4 flex space-x-3">
                            <a href="/edit-note?note_id=<?= $note['id'] ?>">
                                <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</button>
                            </a>
                            <form action="/delete-note" method="POST">
                                <input type="hidden" name="note_id" value="<?= $note['id'] ?>">
                                <button class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center text-gray-600 mt-6">No notes found</p>
        <?php endif; ?>
    </main>
</div>
