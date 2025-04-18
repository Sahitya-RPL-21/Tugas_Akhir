<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALERI INVENTARIS TPKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
  <div class="w-full max-w-4xl mx-auto">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="hidden lg:block lg:w-1/2 bg-cover">
        <img src="{{ asset('TPKU.jpg') }}" alt="Login Image" class="w-full h-full object-cover">
      </div>
          <div class="w-full p-8 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Galeri Inventaris</h2>
            <p class="text-xl text-gray-600 text-center">TPKU TEBUIRENG</p>
            <form action="{{ route('login') }}" method="POST" class="mt-4">
              @csrf
              <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input name="username" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text" required />
              </div>
              <div class="mt-4">
                <div class="flex justify-between">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                </div>
                <input name="password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" required />
              </div>
              <div class="mt-8">
                <button type="submit" class="bg-green-900 text-white font-bold py-2 px-4 w-full rounded hover:bg-green-600">Masuk</button>
              </div>
            </form>
          </div>
    </div>
  </div>
<!-- <div class="w-[450px] px-8 py-6 mt-4 text-left bg-white rounded-xl shadow-lg">
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-green-900">Galeri Inventaris</h1>
    <p class="text-green-900 font-medium">TPKU TEBUIRENG</p>
  </div>

  <form id="loginForm" class="space-y-6">
    <div>
      <label for="username" class="block text-sm font-medium text-green-900">Username</label>
      <div class="flex items-center mt-2 bg-gray-400 text-white rounded-md px-3 py-2 shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12l-4-4-4 4m0 0l4 4 4-4m-4 4V8" />
        </svg>
        <input type="text" name="nama" required placeholder="Username"
          class="bg-transparent w-full outline-none placeholder-white text-white" />
      </div>
    </div>

    <div>
      <label for="password" class="block text-sm font-medium text-green-900">Password</label>
      <div class="flex items-center mt-2 bg-gray-400 text-white rounded-md px-3 py-2 shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1.9-2 2-2s2 .9 2 2v1h-4v-1zM17 11V9a5 5 0 00-10 0v2m12 0H5v10h14V11z" />
        </svg>
        <input type="password" name="password" required placeholder="Password"
          class="bg-transparent w-full outline-none placeholder-white text-white" />
      </div>
    </div>

    <div class="flex justify-center">
      <button type="submit"
        class="w-full flex justify-center items-center py-2 px-9 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-900 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Masuk
      </button>
    </div>
  </form>
</div> -->

</body>
</html>
