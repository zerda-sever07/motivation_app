<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlham Köşesi | Cyber Dark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .code-font { font-family: 'Fira Code', monospace; }

        /* Arka plan: Derin mor ve siyah geçişi */
        .cyber-bg {
            background: radial-gradient(circle at 0% 0%, #2d064d 0%, #050505 50%, #052e16 100%);
        }

        /* Neon Mor Parlama */
        .glow-purple {
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.2);
        }

        /* Neon Yeşil Vurgu */
        .neon-green-text {
            color: #4ade80;
            text-shadow: 0 0 10px rgba(74, 222, 128, 0.5);
        }
    </style>
</head>
<body class="cyber-bg min-h-screen flex items-center justify-center p-6 text-slate-300">

    <div class="max-w-2xl w-full">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-emerald-400 mb-3 italic">
                Duygu Durağı
            </h1>
            <p class="code-font text-emerald-400/80 text-sm tracking-widest">>> Sistemdeki tek hata, hislerini bastırmaktır.</p>
        </div>

        <div class="bg-purple-900/10 backdrop-blur-xl p-8 rounded-3xl border border-purple-500/20 shadow-2xl glow-purple mb-12">
            <form action="{{ route('quotes.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-purple-400 mb-2 ml-1">Günün Sözü</label>
                    <textarea name="content" rows="3"
                        class="w-full border-0 bg-black/40 rounded-2xl p-4 text-emerald-50 placeholder-slate-600 focus:ring-2 focus:ring-emerald-500/50 transition duration-500 resize-none code-font"
                        placeholder="Hislerini kelimelere dök..." required></textarea>
                </div>

                <div class="flex flex-col md:flex-row gap-5">
                    <div class="flex-1">
                        <label class="block text-xs font-bold uppercase tracking-widest text-purple-400 mb-2 ml-1">Yazar Adı</label>
                        <input type="text" name="author"
                            class="w-full border-0 bg-black/40 rounded-2xl p-3 text-emerald-400 placeholder-slate-700 focus:ring-2 focus:ring-purple-500/50 transition duration-500 code-font"
                            placeholder="yazar adı">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full md:w-auto bg-gradient-to-br from-purple-600 to-emerald-600 hover:from-purple-500 hover:to-emerald-500 text-white font-bold py-3 px-10 rounded-2xl transition duration-300 transform hover:scale-105 hover:rotate-1 shadow-lg shadow-purple-500/20">
                            PAYLAŞ
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="space-y-6">
            <div class="flex items-center gap-4 mb-6">
                <h2 class="text-xl font-bold text-white uppercase tracking-tighter">Bugünden...</h2>
                <div class="h-[1px] flex-1 bg-gradient-to-r from-purple-500/50 to-transparent"></div>
            </div>

            @forelse($quotes as $quote)
                <div class="bg-black/40 backdrop-blur-md p-6 rounded-2xl border border-emerald-500/10 hover:border-purple-500/40 transition duration-500 group relative">
                    <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-purple-500 to-emerald-500 rounded-l-full"></div>

                    <div class="flex items-start gap-4">
                        <div class="flex-1">
                            <p class="text-lg text-slate-100 mb-4 leading-relaxed font-medium italic">
                                "{{ $quote->content }}"
                            </p>
                            <div class="flex justify-between items-end">
                                <div>
                                    <span class="neon-green-text font-bold code-font text-sm">~ {{ $quote->author }}</span>
                                    <div class="text-[10px] text-slate-500 mt-1 font-mono uppercase">{{ $quote->created_at->diffForHumans() }}</div>
                                </div>

                                <form action="{{ route('quotes.destroy', $quote) }}" method="POST"
                                    onsubmit="return confirm('Bu log kaydı silinsin mi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 p-2 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white flex items-center justify-center">
                                        <i data-lucide="terminal" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
    <form action="{{ route('quotes.like', $quote) }}" method="POST">
        @csrf
        <button type="submit" class="flex items-center gap-1 text-slate-400 hover:text-pink-500 transition-colors duration-300 group/like">
            <i data-lucide="heart" class="w-4 h-4 group-hover/like:fill-pink-500"></i>
            <span class="text-xs font-mono">{{ $quote->likes }}</span>
        </button>
    </form>

    </div>
            @empty
                <div class="text-center py-16 border border-dashed border-purple-500/20 rounded-3xl">
                    <p class="code-font text-purple-400/50 tracking-widest">EMPTY_DATABASE: NO_DATA_FOUND</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 mb-8 text-center">
            <span class="code-font text-[10px] text-emerald-500/40 bg-emerald-500/5 px-3 py-1 rounded-full border border-emerald-500/10">
                &copy; 2026 ZERDA_SEVER // Duygu Durağı
            </span>
        </div>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>
