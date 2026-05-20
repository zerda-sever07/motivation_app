<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duygu Durağı | Ayarlar</title>
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
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-emerald-400 mb-2 italic">
                Profili Düzenle
            </h1>
            <p class="text-xs text-slate-500 font-mono">>> UPDATE_MODE: BİLGİLERİ_GÜNCELLE</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-3 rounded-xl mb-4 font-mono">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-1 ml-1 font-mono">Kullanıcı Adı</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-1 ml-1 font-mono">E-Posta</label>
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm">
            </div>

            <div class="border-t border-slate-800 my-4 pt-4">
                <p class="text-[10px] text-slate-500 font-mono mb-3 ml-1">Şifreyi değiştirmek istemiyorsanız boş bırakın.</p>

                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-1 ml-1 font-mono">Yeni Şifre</label>
                <input type="password" name="password" class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm mb-3">

                <label class="block text-xs uppercase tracking-widest text-purple-400 mb-1 ml-1 font-mono">Yeni Şifre Tekrar</label>
                <input type="password" name="password_confirmation" class="w-full border-0 bg-black/40 rounded-xl p-3 text-emerald-50 focus:ring-2 focus:ring-emerald-500/50 font-mono text-sm">
            </div>

            <div class="flex flex-row items-center justify-between gap-4 pt-4 w-full">
                <a href="{{ route('profile.show') }}" class="block w-1/2 text-center bg-slate-900 hover:bg-slate-800 text-slate-400 font-bold py-3.5 rounded-xl transition duration-300 text-sm border border-slate-800">
                    İptal
                </a>
                <button type="submit" class="w-1/2 bg-gradient-to-r from-purple-600 to-emerald-600 hover:from-purple-500 hover:to-emerald-500 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg text-sm">
                    KAYDET
                </button>
            </div>
        </form>
    </div>

</body>
</html>
