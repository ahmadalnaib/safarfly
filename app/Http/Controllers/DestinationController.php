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
          $apiKey = env('GOOGLE_MAPS_API_KEY');
          $geocodeResponse = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
              'address' => $address,
              'key' => $apiKey,
          ]);
  
          // Extract necessary information from the response
          $geocodeData = $geocodeResponse->json();
          $photoUrl = null;
          $hotels = [];
  
          // Check if there are results and get the latitude and longitude
          if (isset($geocodeData['results']) && count($geocodeData['results']) > 0) {
              $latitude = $geocodeData['results'][0]['geometry']['location']['lat'];
              $longitude = $geocodeData['results'][0]['geometry']['location']['lng'];
  
              // Call the Google Places API to search for hotels
              $placesResponse = Http::get("https://maps.googleapis.com/maps/api/place/nearbysearch/json", [
                  'location' => "$latitude,$longitude",
                  'radius' => 5000,
                  'type' => 'lodging',
                  'key' => $apiKey,
              ]);
  
              // Extract hotel information from the response
              $placesData = $placesResponse->json();
              if (isset($placesData['results']) && count($placesData['results']) > 0) {
                  foreach ($placesData['results'] as $hotel) {
                      $hotels[] = [
                          'name' => $hotel['name'],
                          'rating' => isset($hotel['rating']) ? $hotel['rating'] : 'N/A',
                          'address' => $hotel['vicinity'],
                          'photoUrl' => isset($hotel['photos']) ? $this->getPhotoUrl($hotel['photos'][0]['photo_reference'], $apiKey) : null,
                      ];
                  }
              }
          }
  
          // Pass the result, photo URL, and hotel data to the view
          return view('results', compact('result', 'photoUrl', 'hotels'));
      }
  
      // Helper function to get photo URL
      private function getPhotoUrl($photoReference, $apiKey)
      {
          return "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=$photoReference&key=$apiKey";
      }
  }