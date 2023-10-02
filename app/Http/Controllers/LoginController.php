<?php
 
namespace App\Http\Controllers;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserId implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (strlen($value) < 2 || !(strpos($value, 'X') == 0 || strpos($value, 'S') == 0)) {
            $fail('uhoh');
        }
    }
}

class LoginController extends Controller
{
    public function get() {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'userId' => ['required', 'string', new UserId],
            'password' => ['required'],
        ]);

        $parsedCredentials = $this->parseCredentials($credentials);

        if (Auth::attempt([
            'id' => $parsedCredentials['id'],
            'password' => $parsedCredentials['password']
        ])) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back();
    }

    private function parseCredentials($credentials) {
        $type = null;
        if (substr($credentials['userId'], 0, 1) == 'X') {
            $type = 'admin';
        }
        if (substr($credentials['userId'], 0, 1) == 'S') {
            $type = 'staff';
        }
        $id = intval(substr($credentials['userId'], 1));
        return
        [
            'id' => $id,
            'type' => $type,
            'password' => $credentials['password']
        ];
    }
}