<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GALERI INVENTARIS TPKU</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
      <p class="text-gray-500 mt-2">Galeri Inventaris TPKU Tebuireng</p>
    </div>
    <form action="{{ route('login') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1" for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Masukkan username Anda" required
          class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
        <input id="username" name="username" type="text" placeholder="Masukkan Password" required
          class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" />
      </div>
        <button type="submit"
          class="w-full bg-green-700 hover:bg-green-800 text-white font-bold py-2 rounded-lg transition duration-300">
          Masuk
        </button>
      </div>
    </form>
  </div>
</body>
</html>