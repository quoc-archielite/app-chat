<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ $friend_messager->name }}</div>
                    </div>
                    <div class="card-body " data-bs-spy="scroll" data-bs-target="#navbar-example" >
                        <div class="box-messager">
                            @forelse($messagers as $key => $value)
                                <div class="row">
                                    @if ($value->id_sender == auth()->user()->id)
                                        <div class="col-6"></div>
                                        <div class="col-6">
                                            <div class="alert alert-info" role="alert" >
                                                <span>{{ $friend_messager->name }}: </span>
                                                <span>{{ $value->content }}</span>
                                                <span class="badge badge-secondary text-gray-400" style="padding-left: 70%">{{ $value->created_at }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <div class="alert alert-primary" role="alert" >
                                                <span>{{ auth()->user()->name }}: </span>
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
                        </div>
                    </div>
                    <div class="card-footer">
                        <form class="row" action="{{ route('send-messager') }}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="hidden" value="{{ $id_receiver }}" name="id_receiver" class="id_receiver">
                                <input type="hidden" value="{{ auth()->id() }}" name="id_sender" class="id_sender">
                                <input type="text" class="form-control" id="content" name="content" placeholder="Messager...">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        $(document).ready(function(){
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#navbar-example'
            })
            var pusher = new Pusher('194a34f389c1f1a76d94', {
                encrypted: true,
                cluster: "ap1"
            });
            var channel = pusher.subscribe('send-messager');

            channel.bind('App\\Events\\SendMessager', getMessagerRealtime);

            function getMessagerRealtime() {
                const id_sender = $('.id_sender').val();
                const id_receiver = $('.id_receiver').val();
                $.ajax({url: "/get-messager-realtime/"+id_sender+'/'+id_receiver,
                    success: function(result){
                       $('.box-messager').html(result);
                }});
            }
        });
    </script>
</x-app-layout>
