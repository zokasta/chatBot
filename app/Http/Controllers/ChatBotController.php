<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// use OpenAI\Laravel\Facades\OpenAI;

// class ChatBotController extends Controller
// {
//     public function sendChat(Request $request){
//         $result = OpenAI::completions()->create([
//             'max_tokens' => 100,
//             'model' => 'gpt-3.5-turbo',
//             'prompt' => $request->input
//         ]);

//         $response = array_reduce(
//             $result->toArray()['choices'],
//             fn(string $result, array $choice) => $result . $choice['text'], ""
//         );

//         return $response;
//     }
// }



//gemini
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string'
            ]);

            $userMessage = $request->input('message');
            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                return response()->json(['error' => 'Gemini API key is missing!'], 500);
            }

            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

            $payload = [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $userMessage]
                        ]
                    ]
                ]
            ];

            $response = Http::post($url, $payload);
            $data = $response->json();

            Log::info('Gemini API Response:', $data);

            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json([
                    'reply' => $data['candidates'][0]['content']['parts'][0]['text']
                ]);
            }

            return response()->json(['error' => 'Invalid response format from Gemini AI'], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation failed: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Chatbot API Error: ' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
