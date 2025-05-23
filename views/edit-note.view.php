<?php require __DIR__ . '/partials/head.php'; ?>
<?php require __DIR__ . '/partials/nav.php'; ?>

<div class="container mx-auto p-6">
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Note</h1>
    </header>
    
    <main class="bg-white p-6 rounded-lg shadow-md">
        <form action="" method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($note['title']) ?>" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content:</label>
                <textarea id="content" name="content" rows="6" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?= htmlspecialchars($note['content']) ?></textarea>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="private" name="private" value="1" 
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="private" class="ml-2 block text-sm text-gray-800"> Set as private</label>
            </div>
            
            <div class="flex justify-between">
                <button type="submit"
                    class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save Changes
                </button>
                <a href="/dashboard" 
                    class="py-2 px-4 bg-gray-600 text-white font-semibold rounded-md shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Cancel
                </a>
            </div>
        </form>
    </main>
</div>
