<x-app-layout>
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-screen  ">
      <!-- Image from Unsplash -->
      <div class="bg-cover bg-center" style="background-image: url('{{ $photoUrl ?? '' }}');"></div>

      <!-- Result -->
      <div class="h-screen overflow-y-scroll bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h1 class="text-2xl font-bold mb-4">Sustainable Trip Suggestions</h1>
          @php
          // Split the result into lines
          $lines = explode("\n", $result);
      @endphp

      @foreach ($lines as $line)
          @if (trim($line) !== '')
              <p class="mb-4">{{ trim($line) }}</p>
          @endif
      @endforeach

      <!-- Display hotels -->
      @if (!empty($hotels))
      <h2>Hotels Near Your Destination:</h2>
      <ul>
          @foreach ($hotels as $hotel)
              <li>
                  <strong>{{ $hotel['name'] }}</strong><br>
                  Rating: {{ $hotel['rating'] }}<br>
                  Address: {{ $hotel['address'] }}<br>
                  @if ($hotel['photoUrl'])
                      <img src="{{ $hotel['photoUrl'] }}" alt="Hotel Photo" style="max-width: 200px;"><br>
                  @else
                      No photo available
                  @endif
              </li>
          @endforeach
      </ul>
  @else
      <p>No hotels found near your destination.</p>
  @endif
</div>
      

      </div>
  </div>
</x-app-layout>