@props(['post'])

@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="POST">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/40?u={{ auth()->id() }}"
                    alt=""
                    width="40"
                    height="40"
                    class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <x-form.field>
                <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none focus:ring p-2"
                    rows="5"
                    placeholder="Quick, think of something to say!"
                    required></textarea>

                <x-form.error name="body" />
            </x-form.field>

            <x-form.button class="flex justify-end pt-6 border-t border-gray200">Post</x-form.button>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a>, or <a href="/login" class="hover:underline">log in</a> to leave a comment.
    </p>
@endauth