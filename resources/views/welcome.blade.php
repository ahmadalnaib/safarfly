<x-app-layout>
     


<section class="py-20 bg-white tails-selected-element" >

    <div class="max-w-6xl px-10 mx-auto xl:px-5">
  
      <div class="flex flex-col justify-center space-y-7">
        
        <h2 class="w-full mx-auto text-4xl font-extrabold leading-none text-left text-red-600 sm:text-5xl md:text-7xl md:text-center"> سفرفاي  </h2>
        <p class="w-full max-w-4xl mx-auto text-xl text-right text-gray-600 md:text-2xl md:text-center">خطط لرحلتك المستدامة في ثوانٍ معدودة</p>

        <form action="" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="flex flex-col w-full mx-auto space-y-5 md:space-y-0 md:space-x-5 md:flex-row">
          <input type="text" id="address" name="address" class="flex-1 w-full px-5 py-5 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl  border border-gray-300 rounded-lg focus:ring-4 focus:border-red-700 focus:ring-red-600 focus:ring-opacity-50 focus:outline-none bg-gray-100 ml-5" data-primary="blue-600" data-rounded="rounded-lg" placeholder="الى ين">
  
          <input type="date" name="date" class="flex-1 w-full px-5 py-5 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl border border-gray-300 rounded-lg focus:ring-4 focus:border-red-700 focus:ring-red-600 focus:ring-opacity-50 focus:outline-none bg-gray-100">
          
  
      
          <button type="submit" class="flex-shrink-0 px-10 py-5 text-2xl font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4 focus:ring-red-600 focus:ring-opacity-50 focus:ring-offset-2 focus:outline-none">انطلق</button>
        </div>
      </form>
      
  
    </div>
  
  </div></section>
  
  <div class="container mx-auto max-w-2xl  mt-10">
    <div class="category mt-1">
        <ul class="flex flex-wrap justify-center">
        {{-- @foreach ($categories as $category) --}}
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1"> الثقافة</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">جولة في المدينة</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">الطبيعة</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">مغامرات</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">الفخامة</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">الصحة </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1"> الحياة الليلية</a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">التعليمية </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">الطبخ </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">روحانية </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">الاسترخاء </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">عائلية </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">التسوق </a>
          </li>
          <li class="py-2 mx-2 my-1 w-full sm:w-full md:w-auto flex justify-center flex-col text-center">
            <a href="}" class="bg-red-600 hover:bg-gray-100 text-white py-2 px-4  rounded-md m-1">لاستجمام </a>
          </li>
        {{-- @endforeach --}}
      </ul>
    </div>
  </div>

</x-app-layout>