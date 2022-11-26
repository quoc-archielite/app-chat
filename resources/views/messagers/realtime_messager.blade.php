<div class="position-relative">
    <div class="chat-messages p-4">
        @forelse($messagers as $key => $value)

            @if ($value->id_sender == auth()->user()->id)
                <div class="chat-message-right pb-4">
                    <div>
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{ $value->created_at }}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                        <div class="font-weight-bold mb-1">You</div>
                        {{ $value->content }}
                    </div>
                </div>
            @else
                <div class="chat-message-left pb-4">
                    <div>
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{ $value->created_at }}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                        <div class="font-weight-bold mb-1">{{ $friend_messager->name }}</div>
                        {{ $value->content }}
                    </div>
                </div>
            @endif
        @empty
            <p>No data</p>
        @endforelse
    </div>
</div>
