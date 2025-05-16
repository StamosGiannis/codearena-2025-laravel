@extends('layouts.app')
@section('content')

<div class="bg-white px-6 py-32 lg:px-8">
  <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
    <h1
      class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
    >
      {{ $post->title }}
    </h1>
    <p class="mt-6 text-xl/8">{{ $post->description }}</p>
    <img
      class="aspect-video rounded-xl bg-gray-50 object-cover mt-10"
      src="{{ $post->image }}"
      alt="{{ $post->title }}"
    />
    <div class="mt-16 max-w-2xl">
      <p class="mt-6">{{ $post->body }}</p>
    </div>
    <div class="mt-16 font-bold">
      <a href="">{{ $post->author->name }}</a>
    </div>
    <div class="mx-auto max-w-3xl mt-16">
      <form id="comment-form" action="{{ route('comment', $post) }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700"
            >Όνομά σας</label
          >
          <input type="text" id="name" required name="name" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
          />
        </div>

        <div>
          <label for="body" class="block text-sm font-medium text-gray-700"
            >Σχόλιό σας</label
          >
          <textarea id="body" required name="body"  rows="4"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
          ></textarea>
        </div>

        <div>
          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            Υποβολή
          </button>
        </div>
      </form>

      @if($comments->count())
        <div class="mt-12 space-y-4">
          @foreach ($comments as $comment)
            <div class="border rounded p-4">
              <strong>{{ $comment->name }}</strong>
              <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
              <p class="mt-2">{{ $comment->body }}</p>
              <form method="POST" action="{{ route('comment.delete', $comment) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
              </form>
            </div>
            
           @endforeach

        </div>
      @endif
    </div>
  </div>
</div>
@endsection
