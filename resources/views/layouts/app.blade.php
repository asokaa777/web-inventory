<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>InventoryApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { 
            scroll-behavior: smooth;
            height: 100%;
        }
        body { 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        body::before {
            content: "";
            position: fixed;
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
        main {
            flex: 1 0 auto;
            padding-top: 6rem;
            padding-bottom: 2rem;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gradient-to-br from-pink-100 via-pink-200 to-pink-300 relative">
    <nav class="bg-gradient-to-r from-pink-300 to-pink-400 bg-opacity-80 backdrop-blur-md fixed w-full z-50 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-pink-900 font-extrabold text-2xl tracking-wide hover:text-pink-700 transition">InventoryApp</a>
            <div class="space-x-4">
                <a href="{{ url('/barang') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Barang</a>
                <a href="{{ url('/peminjaman') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Peminjaman</a>
                <a href="{{ url('/pengembalian') }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded-lg font-medium transition">Pengembalian</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-pink-300 to-pink-400 text-pink-900 border-t border-transparent py-6 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">&copy; <span id="year"></span> InventoryApp</p>
        </div>
    </footer>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>
