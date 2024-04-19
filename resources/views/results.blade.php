<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 h-screen">
      <div class="bg-cover bg-center relative" style="background-image: url('{{ $cityPhotoUrl ?? '' }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 flex justify-center items-center text-white">
          <h1 class="text-4xl font-bold">{{ $cityName }}</h1>
        </div>
      </div>
      <div class="h-screen overflow-y-scroll bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4">اقتراحات الرحلات </h1>
        @php
        $lines = explode("\n", $result);
        @endphp
        @foreach ($lines as $line)
          @if (trim($line) !== '')
            <p class="mb-4 text-lg">{{ trim($line) }}</p>
          @endif
        @endforeach
        @if (!empty($hotels))
          <h2 class="text-2xl font-bold mt-4">الاماكن القريبة من وجهتك</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($hotels as $hotel)
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ $hotel['photoUrl'] ?? 'https://via.placeholder.com/400' }}" alt="Hotel Photo" class="w-full h-48 object-cover">
                <div class="p-4">
                  <h3 class="text-lg font-bold">{{ $hotel['name'] }}</h3>
                  <p class="text-gray-600">التقييم: {{ $hotel['rating'] ?? 'N/A' }}</p>
                  <p class="text-gray-600">العنوان: {{ $hotel['address'] }}</p>
                  @if ($hotel['website'])
                    <a href="{{ $hotel['website'] }}" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">احجز الآن</a>
                  @else
                    <a href="{{ $hotel['google_maps_link'] }}" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">عرض على خرائط جوجل</a>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-lg text-gray-600">No hotels found near your destination.</p>
        @endif
      </div>
    </div>
  </x-app-layout>