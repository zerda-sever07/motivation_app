<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duygu Durağı | Profilim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-[#2d064d] via-[#050505] to-[#052e16] min-h-screen p-6 text-slate-300 flex items-center justify-center">

    <div class="max-w-2xl w-full">
        <div class="flex justify-between items-center mb-10 bg-black/40 p-4 rounded-2xl border border-purple-500/10">
            <a href="{{ route('quotes.index') }}" class="flex items-center gap-2 text-sm font-bold text-emerald-400 hover:underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Durak Ana Akışına Dön
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-mono text-red-400 hover:underline">>> GÜVENLİ_ÇIKIŞ</button>
            </form>
        </div>

        <div class="bg-black/50 border border-purple-500/20 rounded-3xl p-8 mb-8 shadow-2xl flex flex-col md:flex-row items-center gap-8 relative">
            <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-purple-500 to-emerald-400 p-[3px] shadow-[0_0_15px_rgba(168,85,247,0.4)]">
                <div class="w-full h-full bg-[#050505] rounded-full flex items-center justify-center text-3xl font-bold text-white uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
            </div>

            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-col md:flex-row items-center gap-4 mb-3">
                    <h2 class="text-2xl font-bold text-white">@__{{ $user->name }}</h2>
                    <a href="{{ route('profile.edit') }}" class="bg-slate-800/80 hover:bg-slate-700 text-xs font-bold text-slate-200 px-4 py-2 rounded-xl border border-slate-700 transition-all">
                        Profili Düzenle
                    </a>
                </div>
                <p class="text-sm text-slate-400 font-mono">{{ $user->email }}</p>
                <div class="flex gap-6 mt-4 justify-center md:justify-start text-xs font-mono">
                    <span><strong class="text-emerald-400 text-sm">{{ $myQuotes->count() }}</strong> his paylaşımı</span>
                </div>
            </div>
        </div>

        <h3 class="text-lg font-bold text-white mb-4 italic">Bıraktığın İzler</h3>
        <div class="space-y-4">
            @forelse($myQuotes as $quote)
                <div class="bg-black/30 border border-purple-500/10 p-5 rounded-2xl relative group">
                    <p class="text-slate-200 italic mb-2">"{{ $quote->content }}"</p>
                    <div class="flex justify-between items-center text-[10px] text-slate-500 font-mono">
                        <span>{{ $quote->created_at->diffForHumans() }}</span>
                        <span class="text-purple-400 flex items-center gap-1"><i data-lucide="heart" class="w-3 h-3 fill-purple-400"></i> {{ $quote->likes }} Beğeni</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-600 font-mono py-10 border border-dashed border-slate-800 rounded-2xl">Henüz hiçbir his bırakmadın...</p>
            @endforelse
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
