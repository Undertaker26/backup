@php
    $notifications = auth()->user()->notifications()->where('is_read', false)->get();
@endphp

<div class="notifications">
    <h4>Notifications</h4>
    @if($notifications->isEmpty())
        <p>No new notifications</p>
    @else
        <ul>
            @foreach($notifications as $notification)
                <li>
                    @if($notification->type == 'like')
                        {{ $notification->triggerUser->username }} liked your post: <a href="{{ route('posts.show', $notification->post_id) }}">{{ $notification->post->title }}</a>
                    @elseif($notification->type == 'comment')
                        {{ $notification->triggerUser->username }} commented on your post: <a href="{{ route('posts.show', $notification->post_id) }}">{{ $notification->post->title }}</a>
                    @elseif($notification->type == 'share')
                        {{ $notification->triggerUser->username }} shared your post: <a href="{{ route('posts.show', $notification->post_id) }}">{{ $notification->post->title }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
