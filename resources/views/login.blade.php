<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen - Order Management Systeem</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen font-sans">

<!-- Login Card -->
<div class="w-full max-w-md bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
    <h2 class="text-3xl font-bold text-white mb-6 text-center">🔑 Inloggen</h2>

    <!-- Formulier -->

        @csrf
        <!-- Gebruikersnaam -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
            <input type="email" id="email" name="email" required
                   class="w-full mt-2 px-4 py-3 rounded-lg bg-gray-700 text-gray-200 border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="jouw@email.com">
        </div>

        <!-- Wachtwoord -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Wachtwoord</label>
            <input type="password" id="password" name="password" required
                   class="w-full mt-2 px-4 py-3 rounded-lg bg-gray-700 text-gray-200 border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="••••••••">
        </div>

        <!-- Inloggen knop -->
        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition mt-4">
            Inloggen
        </button>
    </form>

</div>

</body>
</html>
