<!DOCTYPE html>
<html>
<head>
    <title>Motivasyon Paylaş</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Günün Sözünü Paylaş</h1>

        <form action="{{ route('quotes.store') }}" method="POST">
            @csrf
            <textarea name="content" class="w-full border p-2 rounded" placeholder="Bir motivasyon sözü yaz..." required></textarea>
            <input type="text" name="author" class="w-full border p-2 mt-2 rounded" placeholder="Yazar adı (opsiyonel)">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600">Paylaş</button>
        </form>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-3">Son Paylaşılanlar</h2>
        @foreach($quotes as $quote)
            <div class="mb-4 p-3 bg-gray-50 rounded border-l-4 border-blue-500">
                <p class="italic text-gray-700">"{{ $quote->content }}"</p>
                <span class="text-sm font-bold">- {{ $quote->author }}</span>
            </div>
        @endforeach
    </div>
</body>
</html>
