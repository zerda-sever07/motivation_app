<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duygu Durağı | His Terminali</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .code-font { font-family: 'Fira Code', monospace; }
        .cyber-bg {
            background: radial-gradient(circle at 0% 0%, #2d064d 0%, #050505 50%, #052e16 100%);
        }
        /* Yanıp sönen neon imleç */
        .cursor-blink {
            display: inline-block; width: 8px; height: 18px;
            background-color: #4ade80; margin-left: 4px;
            animation: blink 1s infinite; vertical-align: middle;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        /* Kaydedilenler için yeşil vurgu */
        .bookmark-active { fill: #4ade80 !important; color: #4ade80 !important; }

        .glow-emerald:hover {
            box-shadow: 0 0 15px rgba(74, 222, 128, 0.3);
        }
    </style>
</head>
<body class="cyber-bg min-h-screen flex items-center justify-center p-6 text-slate-300">

    <div class="max-w-2xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-emerald-400 mb-3 italic">
                Duygu Durağı
            </h1>
            <p class="code-font text-emerald-400/80 text-sm tracking-widest uppercase">
                >> SİSTEMDEKİ TEK HATA HİSLERİNİZİ BASTIRMAKTIR
            </p>
        </div>

        <div class="flex justify-center mb-10">
            <a href="{{ route('quotes.random') }}"
               class="group flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 px-6 py-2 rounded-full text-emerald-400 hover:bg-emerald-500 hover:text-black transition-all duration-300 glow-emerald font-bold text-sm tracking-tighter">
                <i data-lucide="sparkles" class="w-4 h-4 group-hover:rotate-12"></i>
                RASTGELE BİR IŞIK YAK
            </a>
        </div>

        @if(isset($highlight))
            <div class="mb-10 p-[1px] rounded-3xl bg-gradient-to-r from-purple-500 to-emerald-500 shadow-[0_0_20px_rgba(168,85,247,0.3)]">
                <div class="bg-[#050505] p-8 rounded-[23px] text-center">
                    <p class="text-2xl text-white italic font-serif leading-relaxed">"{{ $highlight->content }}"</p>
                    <p class="mt-4 text-emerald-400 code-font font-bold">~ {{ $highlight->author }}</p>
                </div>
            </div>
        @endif

        <div class="bg-purple-900/10 backdrop-blur-xl p-8 rounded-3xl border border-purple-500/20 shadow-2xl mb-12">
            <form action="{{ route('quotes.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="flex items-center text-xs font-bold uppercase tracking-widest text-purple-400 mb-2 ml-1">
                        Bugünden... <span class="cursor-blink"></span>
                    </label>
                    <textarea name="content" rows="3"
                        class="w-full border-0 bg-black/40 rounded-2xl p-4 text-emerald-50 placeholder-slate-600 focus:ring-2 focus:ring-emerald-500/50 transition duration-500 resize-none code-font"
                        placeholder="İçinden geçenleri buraya bırak..." required></textarea>
                </div>
                <div class="flex flex-col md:flex-row gap-5">
                    <input type="text" name="author"
                        class="flex-1 border-0 bg-black/40 rounded-2xl p-3 text-emerald-400 placeholder-slate-700 focus:ring-2 focus:ring-purple-500/50 transition duration-500 code-font"
                        placeholder="@ismin">
                    <button type="submit"
                        class="bg-gradient-to-br from-purple-600 to-emerald-600 hover:from-purple-500 hover:to-emerald-500 text-white font-bold py-3 px-10 rounded-2xl transition duration-300 transform hover:scale-105">
                        PAYLAŞ
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-6" id="quote-list">
            @forelse($quotes as $quote)
                <div class="bg-black/40 backdrop-blur-md p-6 rounded-2xl border border-emerald-500/10 hover:border-purple-500/40 transition duration-500 group relative" id="quote-card-{{ $quote->id }}">
                    <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-purple-500 to-emerald-500 rounded-l-full"></div>

                    <div class="flex flex-col">
                        <p class="text-lg text-slate-100 mb-4 italic leading-relaxed">"{{ $quote->content }}"</p>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-emerald-400 font-bold code-font text-sm">~ {{ $quote->author }}</span>
                                <div class="text-[10px] text-slate-500 mt-1 uppercase font-mono tracking-wider">{{ $quote->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="flex items-center gap-2" id="actions-{{ $quote->id }}">
                                <form action="{{ route('quotes.like', $quote) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 px-3 py-1.5 rounded-xl bg-purple-500/5 text-purple-400/60 hover:bg-purple-500 hover:text-white transition-all border border-purple-500/10">
                                        <i data-lucide="heart" class="w-4 h-4"></i>
                                        <span class="text-xs font-bold">{{ $quote->likes }}</span>
                                    </button>
                                </form>

                                <button onclick="toggleBookmark({{ $quote->id }})" class="p-2 rounded-xl text-slate-600 hover:text-emerald-400 transition-all">
                                    <i data-lucide="bookmark" class="w-4 h-4" id="bookmark-icon-{{ $quote->id }}"></i>
                                </button>

                                <button onclick="downloadQuote({{ $quote->id }})" class="p-2 rounded-xl text-slate-600 hover:text-blue-400 transition-all" title="İndir">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                </button>

                                <form action="{{ route('quotes.destroy', $quote) }}" method="POST" onsubmit="return confirm('Silinsin mi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="opacity-0 group-hover:opacity-100 p-2 text-slate-700 hover:text-red-500 transition-all">
                                        <i data-lucide="terminal" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-600 code-font">Henüz iz yok...</p>
            @endforelse
        </div>
    </div>

    <script>
        lucide.createIcons();

        // 1. LocalStorage Kaydetme Sistemi
        document.addEventListener('DOMContentLoaded', () => {
            const saved = JSON.parse(localStorage.getItem('savedQuotes') || '[]');
            saved.forEach(id => {
                const icon = document.getElementById(`bookmark-icon-${id}`);
                if (icon) icon.classList.add('bookmark-active');
            });
        });

        function toggleBookmark(id) {
            let saved = JSON.parse(localStorage.getItem('savedQuotes') || '[]');
            const icon = document.getElementById(`bookmark-icon-${id}`);
            if (saved.includes(id)) {
                saved = saved.filter(savedId => savedId !== id);
                icon.classList.remove('bookmark-active');
            } else {
                saved.push(id);
                icon.classList.add('bookmark-active');
            }
            localStorage.setItem('savedQuotes', JSON.stringify(saved));
        }

        // 2. Görsel Olarak İndirme (Story Modu)
        function downloadQuote(id) {
            const element = document.getElementById(`quote-card-${id}`);
            const actions = document.getElementById(`actions-${id}`);

            // Çekimden önce butonları gizle
            actions.style.visibility = 'hidden';

            html2canvas(element, {
                backgroundColor: '#050505',
                scale: 3, // Yüksek kalite
                borderRadius: 24,
                logging: false,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = `duygu-duragi-${id}.png`;
                link.href = canvas.toDataURL("image/png");
                link.click();

                // Butonları geri getir
                actions.style.visibility = 'visible';
            });
        }
    </script>
</body>
</html>
