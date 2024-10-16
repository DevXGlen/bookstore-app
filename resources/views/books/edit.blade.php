@php
    use App\Http\Controllers\BookController;
@endphp


@extends('layouts.main')

@section('content')
    <div class="grid justify-items-center w-full my-6">
        <a href="#"
            class=" w-full max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Edit Book</h5>

            <form class="max-w-sm mx-auto" method="POST" action="{{ route('books.update', $book?->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        Book Name</label>
                    <input type="text" id="name" name="name" value="{{ $book?->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="enter book name..." required />
                </div>
                <div class="mb-5">
                    <label for="author"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                    <input type="text" id="author" name="author" placeholder="enter author..."
                        value="{{ $book?->author }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>


                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        Book Image Cover</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" name="image"
                        accept=".png, .jpg, .jpeg">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG (MAX.
                        800x400px).</p>

                    <img class="w-64 aspect-[1/1] object-cover rounded  my-2"
                        src="{{ BookController::getImageUrl($book?->image) }}" alt="Book Image Cover" />
                </div>

                <div class="my-4">
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>

            </form>
        </a>
    </div>
@endsection
