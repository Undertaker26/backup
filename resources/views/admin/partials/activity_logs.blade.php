@foreach ($recentLogs as $log)
    <li class="list-group-item">
                            <!-- <td>{{ $log->id }}</td> -->

    <span class="text-muted">{{ $log->created_at->format('H:i:s') }} |</span>
    {{ $log->user_id}}
        <strong>{{ $log->user->username }}:</strong> 
        {{ $log->activity_type }} - {{ $log->description }} 
    </li>
@endforeach
