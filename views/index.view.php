<?php require __DIR__ . '/partials/head.php'; ?>

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900">Welcome to Notes Application</h1>
        <p class="mt-4 text-lg text-gray-600">Here you can create your notes and use the to-do list</p>
        
        <div class="mt-8 flex justify-center space-x-4">
            <a href="/login" class="w-full sm:w-auto">
                <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
                </button>
            </a>
            <a href="/register" class="w-full sm:w-auto">
                <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Register
                </button>
            </a>
        </div>
    </div>
</div>


