<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use OpenAI;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request){
        $result = OpenAI::completions()->create([
            'max_tokens' => 100,
            'model' => 'gpt-4o',
            'prompt' => $request->input
        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn(string $result, array $choice) => $result . $choice['text'], ""
        );

        return $response;
    }
}
