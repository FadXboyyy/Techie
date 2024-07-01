<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/verify-recaptcha', function (Request $request) {
    $client = new Client();
    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret'   => env('6Lf_C_4pAAAAAEJnZS2ShipKYqDJdu271UMr5QJR'),
            'response' => $request->input('token'),
        ],
    ]);

    $body = json_decode((string) $response->getBody());

    // Handle the response accordingly
    if ($body->success && $body->score > 0.5) {
        // Valid reCAPTCHA
        return response()->json(['message' => 'reCAPTCHA verified'], 200);
    } else {
        // Invalid reCAPTCHA
        return response()->json(['message' => 'Failed to verify reCAPTCHA'], 400);
    }
});
