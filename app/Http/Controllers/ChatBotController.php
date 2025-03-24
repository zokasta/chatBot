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
use Google\Client;
use Google\Service\GeminiAI;  // Gemini API Client

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        // 1. Gemini API Key
        $apiKey = env('GEMINI_API_KEY');  // .env file mai API key store karo

        // 2. User ka input le lo
        $userMessage = $request->input('message');

        // 3. Gemini API Client Initialize Karo
        $client = new Client();
        $client->setApplicationName("Laravel Gemini Chatbot");
        $client->setDeveloperKey($apiKey);

        // 4. Gemini AI Service Initialize Karo
        $gemini = new GeminiAI($client);

        // 5. API Call karke Response lo
        try {
            $response = $gemini->generateContent($userMessage);
            return response()->json(['reply' => $response->text]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

