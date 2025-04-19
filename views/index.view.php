<?php require __DIR__ . '/partials/head.php'; ?>

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900">Welcome to Notes Application</h1>
        <p class="mt-4 text-lg text-gray-600">Here you can create your notes and use the to-do list</p>
        
        <div class="mt-8 flex justify-center">
            <a href="/login" class="w-full sm:w-auto">
                <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Login with Google
                </button>
            </a>
        </div>
    </div>
</div>
