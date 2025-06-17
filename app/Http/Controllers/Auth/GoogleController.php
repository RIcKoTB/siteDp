<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Перенаправлення на Google для авторизації
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Обробка callback від Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Перевіряємо, чи email має правильний домен
            if (!str_ends_with($googleUser->getEmail(), '@student.uzhnu.edu.ua')) {
                return redirect()->route('login')
                    ->with('error', 'Доступ дозволено тільки для студентів з email @student.uzhnu.edu.ua');
            }

            // Шукаємо або створюємо користувача
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Оновлюємо дані існуючого користувача
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            } else {
                // Створюємо нового користувача
                $user = User::create([
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => 'student',
                    'email_verified_at' => now(),
                ]);
            }

            // Авторизуємо користувача
            Auth::login($user);

            return redirect()->intended('/')
                ->with('success', 'Ви успішно увійшли в систему!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Помилка авторизації: ' . $e->getMessage());
        }
    }

    /**
     * Вихід з системи
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Ви успішно вийшли з системи!');
    }
}
