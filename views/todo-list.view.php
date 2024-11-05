<?php require __DIR__ . '/partials/head.php'; ?>
<?php require __DIR__ . '/partials/nav.php'; ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">To-Do List</h1>

    <?php if ($error): ?>
        <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    
    <form action="/todo-list" method="POST" class="mb-6">
        <input type="text" name="description" placeholder="New task..." required class="border p-2 rounded w-full">
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Task</button>
    </form>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h2 class="text-xl font-semibold mb-4">Works to be done</h2>
            <?php foreach ($todos as $todo): ?>
                <?php if (!$todo['completed']): ?>
                    <div class="bg-white p-4 rounded shadow mb-4 flex justify-between items-center">
                        <?php if (isset($_GET['edit_id']) && $_GET['edit_id'] == $todo['id']): ?>
                            <form action="/todo-list" method="POST" class="flex w-full space-x-2">
                                <input type="hidden" name="edit_id" value="<?= $todo['id'] ?>">
                                <input type="text" name="description" value="<?= htmlspecialchars($todo['description']) ?>" required class="border p-2 rounded w-full">
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                                <a href="/todo-list" class="px-4 py-2 bg-gray-300 rounded">Cancel</a>
                            </form>
                        <?php else: ?>
                            <form action="/todo-list" method="POST" class="flex items-center w-full">
                                <input type="hidden" name="todo_id" value="<?= $todo['id'] ?>">
                                <input type="hidden" name="completed" value="1">
                                <input type="checkbox" onchange="this.form.submit()" class="mr-2">
                                <span class="flex-grow"><?= htmlspecialchars($todo['description']) ?></span>
                            </form>
                            <div class="flex space-x-2">
                                <a href="/todo-list?edit_id=<?= $todo['id'] ?>" class="text-blue-500">Edit</a>
                                <form action="/todo-list" method="POST">
                                    <input type="hidden" name="delete_id" value="<?= $todo['id'] ?>">
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Works Done</h2>
            <?php foreach ($todos as $todo): ?>
                <?php if ($todo['completed']): ?>
                    <div class="bg-green-100 p-4 rounded shadow mb-4 flex justify-between items-center">
                        <span><?= htmlspecialchars($todo['description']) ?></span>
                        <form action="/todo-list" method="POST">
                            <input type="hidden" name="delete_id" value="<?= $todo['id'] ?>">
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
