@extends('layouts.main')

@section('content')
    <div>
        <div class="my-4 grid">
            @include('partials._alert')
            <div class="justify-self-end w-80">
                @include('partials._search-input')
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Book Name
                                <a href="{{ route('books.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}"
                                    class="hover:text-blue-500 hover:scale-150"><svg class="w-3 h-3 ms-1.5"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Author
                                <a href="{{ route('books.index', ['sort_by' => 'author', 'sort_order' => request('sort_order') === 'desc' ? 'asc' : 'desc']) }}"
                                    class="hover:text-blue-500 hover:scale-150"><svg class="w-3 h-3 ms-1.5"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Image Cover
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Actions
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        @include('partials._book-table-row', ['book', $book])
                    @empty
                    @endforelse
                </tbody>
            </table>

            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
