<x-app-layout>
     
  <style>
    /* Style for the checkbox label */
    .checkbox-label {
        cursor: pointer;
    }
    /* Style for the checked checkbox label */
    input[type="checkbox"]:checked + .checkbox-label {
        background-color: #6b7280; /* Change the color as desired */
    }
</style>



<section class="py-20 bg-white tails-selected-element" >

    <div class="max-w-6xl px-10 mx-auto xl:px-5">
  
      <div class="flex flex-col justify-center space-y-7">
        
        <h2 class="w-full mx-auto text-4xl font-extrabold leading-none text-left text-red-600 sm:text-5xl md:text-7xl md:text-center"> سفرفاي  </h2>
        <p class="w-full max-w-4xl mx-auto text-xl text-right text-gray-600 md:text-2xl md:text-center ">خطط لرحلتك  في ثوانٍ معدودة</p>

        <form action="{{ route('search') }}" method="post">
          @csrf
        <div class="flex flex-col w-full mx-auto space-y-5 md:space-y-0 md:space-x-5 md:flex-row">
          <input type="text" id="address" name="address"  class="flex-1 w-full px-5 py-5 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl  border border-gray-300 rounded-lg focus:ring-4 focus:border-red-700 focus:ring-red-600 focus:ring-opacity-50 focus:outline-none bg-gray-100 ml-5" data-primary="blue-600" data-rounded="rounded-lg" placeholder="بغداد, الرياض, دبي ...">
  
          <input type="date" name="start_date" value="{{date('Y-m-d')}}" class="flex-1 w-full px-5 py-5 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl border border-gray-300 rounded-lg focus:ring-4 focus:border-red-700 focus:ring-red-600 focus:ring-opacity-50 focus:outline-none bg-gray-100" placeholder="Start Date">
          <div class="flex justify-center items-center text-2xl">
            الى
        </div>
        <input type="date" name="end_date" value="{{date('Y-m-d')}}" class="flex-1 w-full px-5 py-5 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl border border-gray-300 rounded-lg focus:ring-4 focus:border-red-700 focus:ring-red-600 focus:ring-opacity-50 focus:outline-none bg-gray-100" placeholder="End Date">
      
          <button type="submit" class="flex-shrink-0 px-10 py-5 text-2xl font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4 focus:ring-red-600 focus:ring-opacity-50 focus:ring-offset-2 focus:outline-none">انطلق</button>
        </div>


        <div class="container mx-auto max-w-2xl mt-10">
          <div class="category mt-1">
            <ul class="flex flex-wrap justify-center">
            @include('includes.category_list')
            </ul>
          </div>
      
      </div>
      </form>
      
  
    </div>
  
  </div></section>
  


</x-app-layout>

<script>

</script>