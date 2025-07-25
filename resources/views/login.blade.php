<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STOKIN</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/gambar/stokinlogo.ico') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
  <div class="w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[500px]">
    <!-- Bagian kiri: hijau -->
    <div class="bg-[#173720] flex flex-col items-center justify-center py-10 px-8 md:w-1/2 w-full">
      <img src="{{ asset('assets/gambar/stokinutama.png') }}" alt="Logo" class="mx-auto mb-6 w-48 h-48 object-contain">
    </div>

    <!-- Bagian kanan: putih -->
    <div class="bg-white flex flex-col justify-center py-10 px-8 md:w-1/2 w-full">
      <h3 class="text-3xl font-bold text-green-900 text-center">Selamat Datang</h3>
      <p class="text-gray-600 text-center mt-2 mb-6">Silahkan masuk menggunakan akun anda!</p>
      @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4 w-full">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('login') }}" method="POST" class="space-y-6 w-full">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1" for="username">Username</label>
          <input id="username" name="username" type="text" placeholder="Masukkan Username"
            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Masukkan Password"
            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300" />
        </div>
        <button type="submit"
          class="w-full bg-green-700 hover:bg-[#173720] text-white font-bold py-2 rounded-lg transition duration-300">
          Masuk
        </button>
      </form>
    </div>
  </div>
  <p class="text-center text-gray-500 text-sm mt-8">
    &copy; {{ date('Y') }} STOKIN TPKU
  </p>

  <script>
    document.querySelector('form').addEventListener('submit', function(e) {
      const usernameInput = document.getElementById('username');
      const passwordInput = document.getElementById('password');
      const username = usernameInput.value.trim();
      const password = passwordInput.value.trim();
      const errorBox = document.getElementById('error-message');

      // Reset state
      usernameInput.classList.remove('border-red-500');
      passwordInput.classList.remove('border-red-500');
      errorBox.classList.add('hidden');
      errorBox.innerText = '';

      if (!username || !password) {
        e.preventDefault(); // Hentikan form submit

        if (!username) usernameInput.classList.add('border-red-500');
        if (!password) passwordInput.classList.add('border-red-500');

        if (!username && !password) {
          errorBox.innerText = 'Username dan Password harus diisi.';} 

        errorBox.classList.remove('hidden');
      }
    });
  </script>


</body>

</html>