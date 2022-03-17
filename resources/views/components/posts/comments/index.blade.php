@props(['post'])

<section class="col-span-8 col-start-5 mt-10 space-y-6">
    <x-posts.comments.add-form :post="$post" />

    @foreach ($post->comments as $comment)
        <x-posts.comments.item :comment="$comment" />
    @endforeach
</section>