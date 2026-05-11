<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote; // Quote modelimizi kullanacağımızı belirttik

class QuoteController extends Controller
{
    // Tüm sözleri listeleme fonksiyonu
    public function index()
{
    return view('quotes.index', [
        'quotes' => Quote::latest()->get(),
        'trends' => Quote::orderBy('likes', 'desc')->take(3)->get(), // En popüler 3 söz
    ]);
}

    // Yeni sözü veri tabanına kaydetme fonksiyonu
    public function store(Request $request)
    {
        // Formdan gelen veriyi kontrol et (Boş bırakılmasın)
        $request->validate([
            'content' => 'required',
        ]);

        // Veri tabanına kaydet
        Quote::create([
            'user_id' => 1, // Şimdilik elle 1 veriyoruz (ileride giriş yapan kullanıcı id'si olacak)
            'content' => $request->content,
            'author' => $request->author ?? 'Anonim',
        ]);

        // İşlem bitince sayfayı yenile (Geri dön)
        return back();
    }
    public function destroy(\App\Models\Quote $quote)
   {
    // Sözü veri tabanından sil
    $quote->delete();

    // Sayfaya geri dön
    return back();
   }

  public function like(\App\Models\Quote $quote)
{
    $quote->increment('likes');
    return back();
}

public function random()
{
    // Rastgele bir söz seç ve index sayfasına o sözle git
    $randomQuote = \App\Models\Quote::inRandomOrder()->first();
    return view('quotes.index', [
        'quotes' => \App\Models\Quote::latest()->get(),
        'highlight' => $randomQuote // Öne çıkarılacak rastgele söz
    ]);
}
}
