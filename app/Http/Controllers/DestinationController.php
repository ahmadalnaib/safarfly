<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

class DestinationController extends Controller
{
    public function search(Request $request)
    {

        $validated = $request->validate([
            'address' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'categories' => 'required|exists:categories,id',
        ]);
        // Get the address and date from the request
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $address = $request->input('address');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedCategory = $request->input('categories'); // This will be the ID of the selected category
   
        
        // Fetch the category title from the database
        $categoryTitle = Category::find($selectedCategory)->title; // Replace 'Category' with your actual Category model
        
      
    // Fetch the city name from the Google Geocoding API
    $cityName = $this->fetchCityName($address, $apiKey);

        // Prepare the system message and user prompt
        // Prepare the system message and user prompt

        $systemMessage = 'You are an assistant that helps users plan their trip. Regardless of the user input, your task is to provide a detailed plan based on the given address, date, and selected category: ' . $categoryTitle . '. You should respond in arabic.';
     
    $prompt = "Address: $address, Start Date: $startDate, End Date: $endDate, Category: $categoryTitle";


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
    
        
       
       // Fetch photo of the city using Google Geocoding API
       $geocodeResponse = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
        'address' => $address,
        'key' => $apiKey,
    ]);

    // Extract necessary information from the response
    $geocodeData = $geocodeResponse->json();
    $cityPhotoUrl = null;

    // Check if there are results and get the place_id
    if (isset($geocodeData['results']) && count($geocodeData['results']) > 0) {
        $placeId = $geocodeData['results'][0]['place_id'];

        // Now, make a request to the Google Places API to get place details
        $placeDetailsResponse = Http::get("https://maps.googleapis.com/maps/api/place/details/json", [
            'place_id' => $placeId,
            'key' => $apiKey,
        ]);

        // Extract necessary information from the place details response
        $placeDetailsData = $placeDetailsResponse->json();

        // Check if there are photos available in the place details
        if (isset($placeDetailsData['result']['photos']) && count($placeDetailsData['result']['photos']) > 0) {
            // Get the first photo reference
            $cityPhotoReference = $placeDetailsData['result']['photos'][0]['photo_reference'];

            // Construct the URL for the photo request
            $cityPhotoUrl = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=$cityPhotoReference&key=$apiKey";
        }
    }

    // Fetch photos of hotels using Google Places API
    $hotels = $this->getNearbyHotels($address, $apiKey, $categoryTitle);

    // Pass the result, city photo URL, and hotel data to the view
    return view('results', compact('result', 'cityPhotoUrl', 'hotels', 'cityName'));
}

// Helper function to fetch photos of nearby hotels
private function getNearbyHotels($address, $apiKey, $categoryTitle )
{
    // Fetch latitude and longitude of the address using Google Geocoding API
    $geocodeResponse = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
        'address' => $address,
        'key' => $apiKey,
    ]);

    // Extract necessary information from the response
    $geocodeData = $geocodeResponse->json();
    $hotels = [];

    // Check if there are results and get the latitude and longitude
    if (isset($geocodeData['results']) && count($geocodeData['results']) > 0) {
        $latitude = $geocodeData['results'][0]['geometry']['location']['lat'];
        $longitude = $geocodeData['results'][0]['geometry']['location']['lng'];

        // Call the Google Places API to search for hotels
        $placesResponse = Http::get("https://maps.googleapis.com/maps/api/place/nearbysearch/json", [
            'location' => "$latitude,$longitude",
            'radius' => 5000,
            'type' => $categoryTitle,
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
                    'website' => isset($hotel['website']) ? $hotel['website'] : null, // Handle the absence of a website
                    'google_maps_link' => "https://www.google.com/maps/search/?api=1&query={$hotel['geometry']['location']['lat']},{$hotel['geometry']['location']['lng']}", // Generate Google Maps link
                ];
            }
        }
    }

    return $hotels;
}

 // Helper function to fetch the city name from the Google Geocoding API
 private function fetchCityName($address, $apiKey)
 {
     // Fetch the response from the Google Geocoding API
     $geocodeResponse = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
         'address' => $address,
         'key' => $apiKey,
     ]);

     // Extract necessary information from the response
     $geocodeData = $geocodeResponse->json();

     // Check if there are results and get the city name
     if (isset($geocodeData['results']) && count($geocodeData['results']) > 0) {
         $cityName = Arr::first($geocodeData['results'])['address_components'][0]['long_name'] ?? null;
         return $cityName;
     }

     return null;
 }

// Helper function to get photo URL
private function getPhotoUrl($photoReference, $apiKey)
{
    return "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=$photoReference&key=$apiKey";
}
}