<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote; // Quote modelimizi kullanacağımızı belirttik

class QuoteController extends Controller
{
    // Tüm sözleri listeleme fonksiyonu
    public function index()
    {
        // Tüm sözleri en son eklenenden başlayarak getir
        $quotes = Quote::latest()->get();

        // Bu sözleri 'quotes/index.blade.php' sayfasına gönder
        return view('quotes.index', compact('quotes'));
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
}
