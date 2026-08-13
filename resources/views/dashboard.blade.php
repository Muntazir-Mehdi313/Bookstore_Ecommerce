
<x-app-layout>

    <div class="py-4">

        <!-- Categories -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-4">
             
            <x-category-tabs />

            </div>

        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-8">

            @forelse($posts as $post)

          <x-post-item :post="$post" />
            @empty 
               <div>
                <p class="text-center text-gray-500">No posts available.</p>
               </div>
            @endforelse

        </div>
        <div class="flex justify-center mt-8">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>

</x-app-layout>