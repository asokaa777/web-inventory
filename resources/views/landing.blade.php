<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>InventoryApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html { scroll-behavior: smooth; }
    body::before {
      content: "";
      position: absolute;
      top: -100px;
      left: -100px;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(255,192,203,0.15), transparent);
      z-index: -1;
      animation: float 8s infinite ease-in-out alternate;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      100% { transform: translateY(50px); }
    }
  </style>
</head>
<body class="font-sans text-gray-800 bg-gradient-to-br from-pink-100 via-pink-200 to-pink-300 min-h-screen flex flex-col relative overflow-hidden">

  <nav class="bg-gradient-to-r from-pink-300 to-pink-400 bg-opacity-80 backdrop-blur-md fixed w-full z-50 shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="text-pink-900 font-extrabold text-2xl tracking-wide hover:text-pink-700 transition">InventoryApp</a>
      <div class="space-x-4">
        <a href="{{ url('/barang') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Barang</a>
        <a href="{{ url('/peminjaman') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Peminjaman</a>
        <a href="{{ url('/pengembalian') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Pengembalian</a>
      </div>
    </div>
  </nav>

  <header class="pt-28 pb-20 text-center max-w-4xl mx-auto px-6 relative">
    <h1 class="text-5xl md:text-6xl font-extrabold text-pink-700 leading-tight drop-shadow-sm">
      Sistem Peminjaman Barang Elektronik
    </h1>
    <p class="mt-6 text-lg md:text-xl text-pink-600 font-light max-w-3xl mx-auto leading-relaxed">
      Kelola proses peminjaman dan pengembalian barang elektronik dengan mudah dan terorganisir melalui dashboard kami.
    </p>
    <a href="{{ url('/barang') }}" class="mt-10 inline-block bg-pink-400 hover:bg-pink-500 text-pink-900 font-semibold py-4 px-10 rounded-xl shadow-lg transition">
      Lihat Daftar Barang
    </a>
  </header>

  <footer class="bg-gradient-to-r from-pink-300 to-pink-400 text-pink-900 border-t border-transparent py-6 mt-auto text-center relative">
    <p class="text-sm">&copy; <span id="year"></span> InventoryApp. Dibuat dengan Laravel ❤️</p>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>
