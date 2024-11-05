<?php require __DIR__ . '/partials/head.php'; ?>
<?php require __DIR__ . '/partials/nav.php'; ?>

<div class="container mx-auto p-6">
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Create a New Note</h1>
    </header>
    
    <main class="bg-white p-6 rounded-lg shadow-md">
        <?php if (!empty($error)): ?>
            <p class="text-red-500 mb-4"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="/create-note" method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" id="title" name="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content:</label>
                <textarea id="content" name="content" rows="6" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Save Note
            </button>
        </form>
    </main>
</div>
