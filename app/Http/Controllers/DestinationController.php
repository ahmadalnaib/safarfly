<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

class DestinationController extends Controller
{
    public function search(Request $request)
    {
        // Get the address and date from the request
        $address = $request->input('address');
        $date = $request->input('date');

        // Prepare the system message and user prompt
    
        $systemMessage = 'You are an assistant that helps users plan their sustainable trip. You should provide information based on the given address.You should respond in arabic.';
  
        $prompt = "Address: $address, Date: $date";

        // Call the OpenAI API
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo-16k',
            'max_tokens' => 2048,
            'messages' => [
                ['role' => 'system', 'content' => $systemMessage],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        // Get the content of the first choice
        $result = $response['choices'][0]['message']['content'];
        
        // Call the Google Maps Geocoding API
        $geocodingResponse = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ]);

        // Get the coordinates of the address
       dd($geocodingResponse);

        // Pass the result to a view
        return view('results', ['result' => $result, 'coordinates' => $coordinates]);
    }
  
}
