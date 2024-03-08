<div>
    @if($posts->count())
        <div class="container grid-cols-2 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 items-center justify-center mx-auto px-6 ">
            @foreach($posts as $post)
                <div class="hover:scale-110	ease-linear" >
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        
                    </a>
                    <p class="font-bold text-center text-xs py-2 text-gray-500">{{ $post->user->username }}</p>

                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center">No Hay Posts</p>
    @endif
</div>