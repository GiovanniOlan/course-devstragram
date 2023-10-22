@extends('layouts.app')

@push('styles')
    <link
        type="text/css"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        rel="stylesheet"
    />
@endpush

@section('title')
    Crear Publicación
@endsection

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center @error('image_url') border-red-500 @enderror"
                id="dropzone"
                action="{{ route('images.store') }}"
                enctype="multipart/form-data"
                method="POST"
            >@csrf</form>

            @error('image_url')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form
                action="{{ route('posts.create') }}"
                method="POST"
                novalidate
            >
                @csrf
                <div class="mb-5">
                    <label
                        class="mb-2 block uppercase text-gray-500 font-bold"
                        for="title"
                    >
                        Titulo
                    </label>

                    <input
                        class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror"
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        placeholder="Titulo de la publicación"
                    >

                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label
                        class="mb-2 block uppercase text-gray-500 font-bold"
                        for="description"
                    >
                        Descripción
                    </label>

                    <textarea
                        class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror"
                        id="description"
                        name="description"
                        type="text"
                        placeholder="Descripción de la publicación"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input
                        class="border p-3 w-full rounded-lg"
                        id="image_url"
                        name="image_url"
                        type="hidden"
                        value="{{ old('image_url') }}"
                    >
                </div>
                <input
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    type="submit"
                    value="Crear Publicación"
                >
            </form>
        </div>
    </div>
@endsection
