<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public static function generate($prompt)
    {
        $response = Http::withHeaders(
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
            ])
            ->post('https://api.openai.com/v1/chat/completions', 
                [
                    "model" => "gpt-3.5-turbo",
                    "messages" => [[
                        "role" => "user", 
                        "content" => $prompt
                    ]],
                    "temperature" => 0.7
                ]);
                
            return $response->body();
    }
}