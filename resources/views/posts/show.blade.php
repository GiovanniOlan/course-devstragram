@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img
                src="{{ asset('uploads/img') . '/' . $post->image_url }}"
                alt="Imagen del post {{ $post->title }}"
            />
            <div class="p-3">
                0 Likes
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-6">
                    {{ $post->description }}
                </p>
            </div>
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form
                        action="{{ route('comments.store', compact('user', 'post')) }}"
                        method="POST"
                    >
                        @csrf
                        <div class="mb-5">
                            <label
                                class="mb-2 block uppercase text-gray-500 font-bold"
                                for="comment"
                            >
                                Añade un comentario
                            </label>

                            <textarea
                                class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"
                                id="comment"
                                name="comment"
                                type="text"
                                placeholder="Agrega un comentario"
                            >{{ old('comment') }}</textarea>

                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                            type="submit"
                            value="Enviar Comentario"
                        >
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a
                                    class="font-bold"
                                    href="{{ route('posts.index', ['user' => $comment->user]) }}"
                                >
                                    {{ $comment->user->username }}
                                </a>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
