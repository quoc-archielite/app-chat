@forelse($messagers as $key => $value)
    <div class="row">
        @if ($value->id_sender == auth()->user()->id)
            <div class="col-6"></div>
            <div class="col-6">
                <div class="alert alert-info" role="alert" >
                    <span>{{ $value->id_sender }}: </span>
                    <span>{{ $value->content }}</span>
                    <span class="badge badge-secondary text-gray-400" style="padding-left: 70%">{{ $value->created_at }}</span>
                </div>
            </div>
        @else
            <div class="col-6">
                <div class="alert alert-primary" role="alert" >
                    <span>{{ $value->id_sender }}: </span>
                    <span>{{ $value->content }}</span>
                    <span class="badge badge-secondary text-gray-400" style="padding-left: 70%">{{ $value->created_at }}</span>
                </div>
            </div>
            <div class="col-6"></div>
        @endif

    </div>
@empty
    <p>No data</p>
@endforelse
