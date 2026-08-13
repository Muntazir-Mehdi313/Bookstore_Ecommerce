
                <ul class="flex justify-center flex-wrap text-sm font-medium">

                    <li class="mr-2">
                        <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
                            All
                        </a>
                    </li>

                    @foreach($categories as $category)
                    <li class="mr-2">
                        <a href="#" class="inline-block px-4 py-2 rounded-lg hover:bg-gray-100 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach

                </ul>

