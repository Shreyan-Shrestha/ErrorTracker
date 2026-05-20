<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <title>User Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 ">
        <h1 class="text-2xl font-bold mb-6 text-center">User Login</h1>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @if($errors->has('email'))
            {{ $errors->first('email') }}
            @else
            {{ $errors->first() }}
            @endif
        </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" autocomplete="email" 
                class="block w-full px-4 py-2 border rounded focus:outline-none focus:ring"
                placeholder="Enter valid email">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring"
                placeholder="Enter password">
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-700">Remember me</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Sign In
            </button>
        </form>
    </div>

</body>

</html>