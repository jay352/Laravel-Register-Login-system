<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ApiTokenController extends Controller
{
     public function update(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('jay', $token),
        ])->save();

        return ['token' => $token];
    }
}
