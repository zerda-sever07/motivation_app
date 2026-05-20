<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duygu Durağı | Giriş Yap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .cyber-bg { background: radial-gradient(circle at 0% 0%, #2d064d 0%, #050505 50%, #052e16 100%); }
    </style>
</head>
<body class="cyber-bg min-h-screen flex items-center justify-center p-6 text-slate-300">

    <div class="max-w-md w-full bg-black/60 backdrop-blur-xl p-8 rounded-3xl border border-purple-500/20 shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-emerald-400 mb-2 italic">
                Duygu Durağı
            </h1>
            <p class="text-xs text-slate-500 font-mono">>> AUTH_REQUIRED: SİSTEME_BAĞLANIN</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-3 rounded-xl mb-4 font-mono">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/giris') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-2 ml-1 font-mono">E-Posta</label>
                <input type="email" name="email" required class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-2 ml-1 font-mono">Şifre</label>
                <input type="password" name="password" required class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-emerald-600 hover:from-purple-500 hover:to-emerald-500 text-white font-bold py-3 rounded-xl transition duration-300 shadow-lg">
                GİRİŞ YAP
            </button>
        </form>

        <p class="text-center text-xs text-slate-500 mt-6">
            Henüz profilin yok mu? <a href="{{ route('register') }}" class="text-emerald-400 hover:underline">Kayıt Ol</a>
        </p>
    </div>

</body>
</html>
