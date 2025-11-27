<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Jadwalin Warga</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
  class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-900 via-black to-gray-800 text-white font-poppins">

  <div class="w-full max-w-md bg-gray-900/80 backdrop-blur-md rounded-2xl shadow-lg p-8">
    <h1 class="text-3xl font-bold text-center text-blue-500 mb-6">Login</h1>
    <form method="POST" action="../aksi/aksi_login.php" class="space-y-5">

      <!-- Username -->
      <div>
        <label for="username" class="block text-sm mb-2">Username</label>
        <input type="text" id="username" name="username" required
          class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm mb-2">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">
      </div>

      <!-- Remember me + Forgot -->
      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" class="accent-blue-500">
          Remember me
        </label>
        <a href="#" class="text-blue-400 hover:underline">Forgot Password?</a>
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition duration-300">
        Login
      </button>

      <!-- Register -->
      <p class="text-center text-sm mt-4">
        Gak punya akun?
        <a href="register.php" class="text-blue-400 hover:underline">Register</a>
      </p>
    </form>
  </div>

</body>

</html>