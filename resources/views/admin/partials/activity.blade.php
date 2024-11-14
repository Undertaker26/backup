@foreach ($recentLogs as $log)
    <li class="list-group-item">
                            <!-- <td>{{ $log->id }}</td> -->

    <span class="text-muted">{{ $log->created_at->format('Y-m-d | H:i:s') }} |</span>
    {{ $log->id}} |         {{ $log->activity_type }} |
        <strong>{{ $log->user->username }}</strong> 
{{ $log->description }} 
    </li>
@endforeach
