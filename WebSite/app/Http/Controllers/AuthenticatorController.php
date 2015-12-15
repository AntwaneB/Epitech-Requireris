<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Token;
use Auth;

use App\Authenticator;

class AuthenticatorController extends Controller
{

    public function show($id)
    {
        $token = Token::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        try
        {
            $datas = [
                'totp' => Authenticator::getCode($token->token),
            ];

            return ($datas);
        } catch (\Exception $e)
        {
            return ([
                'error' => 'Error while processing token',
            ]);
        }
    }

}
