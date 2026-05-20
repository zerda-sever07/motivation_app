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
        .cursor-blink {
            display: inline-block; width: 8px; height: 18px;
            background-color: #4ade80; margin-left: 4px;
            animation: blink 1s infinite; vertical-align: middle;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        .bookmark-active { fill: #4ade80 !important; color: #4ade80 !important; }
        .glow-emerald:hover { box-shadow: 0 0 15px rgba(74, 222, 128, 0.3); }
        .filter-btn.active { background-color: rgba(74, 222, 128, 0.2); color: #4ade80; border-color: #4ade80; }

        /* Profil İkonu İçin Parlama Efekti */
        .profile-glow:hover { box-shadow: 0 0 20px rgba(168, 85, 247, 0.4); }
    </style>
</head>
<body class="cyber-bg min-h-screen flex items-center justify-center p-6 text-slate-300 relative">

    <div class="absolute top-6 left-6 z-50">
        <a href="{{ route('profile.show') }}" class="group flex items-center gap-3 bg-black/60 backdrop-blur-md border border-purple-500/20 p-2 pr-4 rounded-2xl transition-all duration-300 profile-glow hover:border-purple-500/50">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-purple-500 to-emerald-400 p-[2px] relative">
                <div class="w-full h-full bg-[#050505] rounded-[10px] flex items-center justify-center text-xs font-bold text-white uppercase">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <span class="absolute -bottom-0.5 -right-0.5 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
            </div>
            <div class="flex flex-col">
                <span class="text-white font-bold text-xs group-hover:text-purple-400 transition-colors">@__{{ Auth::user()->name }}</span>
                <span class="text-[9px] text-slate-500 font-mono tracking-tighter">PROFİLİ_AÇ</span>
            </div>
        </a>
    </div>

    <div class="max-w-2xl w-full mt-24 md:mt-0">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-emerald-400 mb-3 italic">
                Duygu Durağı
            </h1>
            <p class="code-font text-emerald-400/80 text-sm tracking-widest uppercase">
                >> SİSTEMDEKİ TEK HATA HİSLERİNİZİ BASTIRMAKTIR
            </p>
        </div>

        <div class="flex justify-center mb-10">
            <a href="{{ route('quotes.random') }}" class="group flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 px-6 py-2 rounded-full text-emerald-400 hover:bg-emerald-500 hover:text-black transition-all duration-300 glow-emerald font-bold text-sm tracking-tighter">
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

        <div class="flex justify-center gap-4 mb-8">
            <button onclick="filterQuotes('all')" id="btn-all" class="filter-btn active border border-slate-700 px-6 py-2 rounded-full text-sm font-bold transition-all">HEPSİ</button>
            <button onclick="filterQuotes('saved')" id="btn-saved" class="filter-btn border border-slate-700 px-6 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2"><i data-lucide="bookmark" class="w-4 h-4"></i> KAYDEDİLENLER</button>
        </div>

        <div id="input-section" class="bg-purple-900/10 backdrop-blur-xl p-8 rounded-3xl border border-purple-500/20 shadow-2xl mb-12">
            <form action="{{ route('quotes.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="flex items-center text-xs font-bold uppercase tracking-widest text-purple-400 mb-2 ml-1">
                        Bugünden... <span class="cursor-blink"></span>
                    </label>
                    <textarea name="content" rows="3" class="w-full border-0 bg-black/40 rounded-2xl p-4 text-emerald-50 placeholder-slate-600 focus:ring-2 focus:ring-emerald-500/50 transition duration-500 resize-none code-font" placeholder="İçinden geçenleri buraya bırak..." required></textarea>
                </div>
                <div class="flex flex-col md:flex-row gap-5 items-center justify-between">
                    <div class="text-xs text-emerald-400/60 font-mono self-start md:self-center ml-1">
                        >> Paylaşan: <span class="text-emerald-400 font-bold">@_{{ Auth::user()->name }}</span>
                    </div>
                    <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                    <button type="submit" class="w-full md:w-auto bg-gradient-to-br from-purple-600 to-emerald-600 hover:from-purple-500 hover:to-emerald-500 text-white font-bold py-3 px-10 rounded-2xl transition duration-300 transform hover:scale-105 shadow-lg">PAYLAŞ</button>
                </div>
            </form>
        </div>

        <div class="space-y-6" id="quote-container">
            @forelse($quotes as $quote)
                <div class="quote-card bg-black/40 backdrop-blur-md p-6 rounded-2xl border border-emerald-500/10 hover:border-purple-500/40 transition duration-500 group relative" id="quote-card-{{ $quote->id }}" data-id="{{ $quote->id }}">
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
                                <button onclick="toggleBookmark({{ $quote->id }})" class="p-2 rounded-xl text-slate-600 hover:text-emerald-400 transition-all"><i data-lucide="bookmark" class="w-4 h-4" id="bookmark-icon-{{ $quote->id }}"></i></button>
                                <button onclick="downloadQuote({{ $quote->id }})" class="p-2 rounded-xl text-slate-600 hover:text-blue-400 transition-all"><i data-lucide="download" class="w-4 h-4"></i></button>
                                <form action="{{ route('quotes.destroy', $quote) }}" method="POST" onsubmit="return confirm('Silinsin mi?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="opacity-0 group-hover:opacity-100 p-2 text-slate-700 hover:text-red-500 transition-all"><i data-lucide="terminal" class="w-4 h-4"></i></button>
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
        function filterQuotes(type) {
            const cards = document.querySelectorAll('.quote-card');
            const saved = JSON.parse(localStorage.getItem('savedQuotes') || '[]');
            const inputSection = document.getElementById('input-section');
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(`btn-${type}`).classList.add('active');
            cards.forEach(card => {
                const id = parseInt(card.getAttribute('data-id'));
                if (type === 'all') { card.style.display = 'block'; inputSection.style.display = 'block'; }
                else { card.style.display = 'none'; inputSection.style.display = 'none'; if (saved.includes(id)) card.style.display = 'block'; }
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            const saved = JSON.parse(localStorage.getItem('savedQuotes') || '[]');
            saved.forEach(id => { const icon = document.getElementById(`bookmark-icon-${id}`); if (icon) icon.classList.add('bookmark-active'); });
        });
        function toggleBookmark(id) {
            let saved = JSON.parse(localStorage.getItem('savedQuotes') || '[]');
            const icon = document.getElementById(`bookmark-icon-${id}`);
            if (saved.includes(id)) { saved = saved.filter(savedId => savedId !== id); icon.classList.remove('bookmark-active'); }
            else { saved.push(id); icon.classList.add('bookmark-active'); }
            localStorage.setItem('savedQuotes', JSON.stringify(saved));
        }
        function downloadQuote(id) {
            const element = document.getElementById(`quote-card-${id}`);
            const actions = document.getElementById(`actions-${id}`);
            actions.style.visibility = 'hidden';
            html2canvas(element, { backgroundColor: '#050505', scale: 3, borderRadius: 24, useCORS: true }).then(canvas => {
                const link = document.createElement('a'); link.download = `duygu-duragi-${id}.png`; link.href = canvas.toDataURL("image/png"); link.click(); actions.style.visibility = 'visible';
            });
        }
    </script>
</body>
</html>
