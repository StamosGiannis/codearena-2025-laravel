@extends('layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">
            {{ $title ?? 'Blog page' }}
        </h2>
      </div>
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @forelse($posts as $post)
                <x-blog.post :post="$post" />
            @empty
                <div class="col-span-full text-center text-gray-500 text-lg">
                    No posts found.
                </div>
            @endforelse
      </div>
      <div class="mt-16">
        {{ $posts->links() }}
      </div>
      
      @if(!empty($authors) && $authors->count())
        <section id="authors" class="mt-24 border-t border-gray-200 pt-12">
            <h3 class="text-3xl font-semibold text-center mb-6 text-gray-800">Authors</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-center">
                @foreach($authors as $author)
                    <a href="{{ route('author', $author) }}" class="block p-4 rounded-lg shadow-sm bg-gray-100 hover:bg-gray-200">
                        <div class="text-lg font-medium text-gray-900">{{ $author->name }}</div>
                        <div class="text-sm text-gray-600">{{ $author->email }}</div>
                    </a>
                @endforeach
            </div>
        </section>
      @endif
    </div>
  </div>
@endsection