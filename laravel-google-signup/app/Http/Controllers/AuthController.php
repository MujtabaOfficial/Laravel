<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
// use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Google;


class AuthController extends Controller
{
    public function googleSignUp(Request $request)
    {
        $provider = new Google([
            'clientId' => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
        ]);

        try {
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->code
            ]);

            $resourceOwner = $provider->getResourceOwner($accessToken);
            $user = User::firstOrNew(['google_id' => $resourceOwner->getId()]);
            $user->name = $resourceOwner->getName();
            $user->email = $resourceOwner->getEmail();
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['message' => 'Successfully signed up with Google'], 200);
    }
}
