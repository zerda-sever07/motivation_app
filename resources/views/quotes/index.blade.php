<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Günün Motivasyonu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Playfair+Display:italic,wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .quote-font { font-family: 'Playfair Display', serif; }
        .soft-gradient {
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
        }
    </style>
</head>
<body class="soft-gradient min-h-screen flex items-center justify-center p-4">

    <div class="max-w-2xl w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">İlham Köşesi</h1>
            <p class="text-gray-600 italic text-lg">Bir ışık da sen bırak...</p>
        </div>

        <div class="bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-white/50 mb-10">
            <form action="{{ route('quotes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Bugünkü Mesajın</label>
                    <textarea name="content" rows="3"
                        class="w-full border-0 bg-gray-50/50 rounded-2xl p-4 text-gray-800 focus:ring-2 focus:ring-amber-200 transition duration-300 resize-none"
                        placeholder="Kalbinden geçen bir motivasyon cümlesi..." required></textarea>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">İmza</label>
                        <input type="text" name="author"
                            class="w-full border-0 bg-gray-50/50 rounded-2xl p-3 text-gray-800 focus:ring-2 focus:ring-amber-200 transition duration-300"
                            placeholder="Adın veya Anonim">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full md:w-auto bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 px-8 rounded-2xl transition duration-300 transform hover:scale-105 shadow-md">
                            Paylaş
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 ml-2">Son İlhamlar</h2>

            @forelse($quotes as $quote)
                <div class="bg-white/60 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-white/40 hover:shadow-md transition duration-300 group relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <span class="text-4xl text-amber-600/30 quote-font">“</span>
                        <div class="flex-1">
                            <p class="text-xl text-gray-800 quote-font mb-3 leading-relaxed">
                                {{ $quote->content }}
                            </p>
                            <div class="flex justify-between items-end">
                                <div>
                                    <span class="text-sm font-semibold text-amber-800/70">— {{ $quote->author }}</span>
                                    <div class="text-[10px] text-gray-400 mt-1">{{ $quote->created_at->diffForHumans() }}</div>
                                </div>

                                <form action="{{ route('quotes.destroy', $quote) }}" method="POST"
                                    onsubmit="return confirm('Bu güzel düşünceyi silmek istediğine emin misin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 p-2 rounded-full hover:bg-red-50 text-red-300 hover:text-red-500 flex items-center justify-center"
                                        title="Sil">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-white/30 rounded-2xl border border-dashed border-gray-400">
                    <p class="text-gray-500 italic text-lg">Henüz hiç ilham bırakılmamış. İlkini sen paylaş!</p>
                </div>
            @endforelse
        </div>

        <p class="text-center text-gray-500 text-sm mt-12 mb-6 italic">
            Zihnini sakinleştir, ruhunu besle.
        </p>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>
