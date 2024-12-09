<?php require __DIR__ . '/partials/head.php'; ?>
<?php require __DIR__ . '/partials/nav.php'; ?>


<div class="container mx-auto p-6">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Notes</h1>
    </header>

    <main>
        <form method="GET" action="/dashboard" class="flex space-x-4 mb-4">
            <div>
                <label for="perPage" class="text-gray-700 font-medium">Per Page</label>
                <select name="perPage" id="perPage" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="this.form.submit()">
                    <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="15" <?= $perPage == 15 ? 'selected' : '' ?>>15</option>
                </select>
            </div>

            <div>
                <label for="order" class="text-gray-700 font-medium">Order</label>
                <select name="order" id="order" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="this.form.submit()">
                    <option value="newest" <?= $order == 'newest' ? 'selected' : '' ?>>Newest</option>
                    <option value="oldest" <?= $order == 'oldest' ? 'selected' : '' ?>>Oldest</option>
                    <option value="alphabetical" <?= $order == 'alphabetical' ? 'selected' : '' ?>>Alphabetical</option>
                </select>
            </div>
        </form>
        <?php if (!empty($notes)): ?>
            <form action="/delete-notes" method="POST">
                <?php 

                    $selectedNotes = $_POST['note_ids'] ?? [];
                    $allNotesSelected = !empty($notes) && count($selectedNotes) === count($notes);
                ?>

                <div class="mb-4 flex items-center">
                    <input 
                        type="checkbox" 
                        id="selectAllCheckbox" 
                        name="select_all" 
                        class="mr-2"
                        <?= $allNotesSelected ? 'checked' : '' ?>
                        onclick="document.querySelectorAll('input[name=\'note_ids[]\']').forEach(cb => cb.checked = this.checked)"
                    >
                    <label for="selectAllCheckbox" class="text-gray-700 font-medium">Select All</label>
                </div>

                <ul class="space-y-4">
                    <?php foreach ($notes as $note): ?>
                        <li class="p-4 bg-white rounded-lg shadow-md flex items-start space-x-4">

                            <input 
                                type="checkbox" 
                                name="note_ids[]" 
                                value="<?= $note['id'] ?>" 
                                <?= in_array($note['id'], $selectedNotes) ? 'checked' : '' ?>
                            >
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($note['title']) ?></h2>
                                <p class="mt-2 text-gray-700"><?= htmlspecialchars($note['content']) ?></p>
                                <small class="block mt-4 text-gray-500">Created at: <?= $note['created_at'] ?></small>
                                <div class="mt-4 flex space-x-3">
                                    <a href="/edit-note?note_id=<?= $note['id'] ?>">
                                        <button type="button" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                        Delete Selected
                    </button>
                </div>
            </form>

            <div class="mt-6 flex justify-center space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>&per_page=<?= $perPage ?>&order=<?= $order ?>"
                       class="px-3 py-1 border rounded <?= $currentPage == $i ? 'bg-gray-700 text-white' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600 mt-6">No notes found</p>
        <?php endif; ?>
    </main>
</div>