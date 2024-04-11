<x-app-layout>
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-screen  ">
      <!-- Image from Unsplash -->
      <div class="bg-cover bg-center " style="background-image: url('https://source.unsplash.com/random');"></div>

      <!-- Result -->
      <div class="h-screen overflow-y-scroll bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h1 class="text-2xl font-bold mb-4">Sustainable Trip Suggestions</h1>

          @php
          // Split the result into lines
          $lines = explode("◀", $result);
      @endphp

      @foreach ($lines as $line)
          @if (trim($line) !== '')
              @php
                  // Extract the location name from the line
                  $location = explode(':', $line)[0];
                  // Generate a Google Maps link for the location
                  $link = 'https://www.google.com/maps/search/' . urlencode($location);
              @endphp
              <p class="mb-4">
                  {{ trim($line) }}
                  <a href="{{ $link }}" target="_blank">View on Google Maps</a>
              </p>
          @endif
      @endforeach

      </div>
  </div>
</x-app-layout>