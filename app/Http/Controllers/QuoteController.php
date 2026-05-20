<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote; // Quote modelimizi kullanacağımızı belirttik
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

// Giriş ve Kayıt Sayfalarını Göster
public function showLogin() { return view('login'); }
public function showRegister() { return view('register'); }

// Kayıt Olma İşlemi
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);
    return redirect()->route('quotes.index');
}

// Giriş Yapma İşlemi
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('quotes.index');
    }

    return back()->withErrors(['email' => 'Giriş bilgileri hatalı.']);
}

// Çıkış Yapma İşlemi
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}
// Profil Sayfası (Kullanıcının kendi paylaştığı sözler listelenir)
public function profile()
{
    $user = Auth::user();
    // Sadece bu kullanıcının paylaştığı sözleri getirir
    $myQuotes = \App\Models\Quote::where('user_id', $user->id)->latest()->get();

    return view('profile', compact('user', 'myQuotes'));
}

// Profili Düzenleme Sayfası
public function editProfile()
{
    $user = Auth::user();
    return view('profile-edit', compact('user'));
}

// Profil Güncelleme İşlemi (Instagram Tarzı)
public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profil başarıyla güncellendi.');
}
}
