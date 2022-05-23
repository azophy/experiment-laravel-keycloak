<?php
/*
 * Kita perlu membuat controller ini (tidak bisa langsung dimasukkan ke
 * file route/web.php) karena setting keycloak ini baru ter-load setelah
 * loading file route, sehingga setting keycloak ini tidak akan terbaca jika
 * ditaruh di router.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('keycloak')->user();

        return response()->json($user);
    }
}
