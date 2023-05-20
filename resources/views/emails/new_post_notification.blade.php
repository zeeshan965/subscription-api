<x-mail::message>
# New Post Notification

A new post has been published:

**Title:** {{ $post->title }}
<br>
**Description:** {{ $post->description }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
