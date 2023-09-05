@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button type="submit" id="fire-notification" class="btn btn-primary">Fire</button>
                    <button type="button" class="btn btn-primary">
                        Notifications 
                        <span class="badge badge-light" id="notification-numbers">
                            {{ $notifications }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>

    function fire_notification() {
        return axios.post("{{ route('store-notification') }}").then(res => {
            return res.data.data.notif;
        })
    }
    $( "#fire-notification" ).click(function() {
        let notif = fire_notification()
        // if (notif) {
        //     let numbers = parseInt($('#notification-numbers').text());
        //     $('#notification-numbers').text(numbers+1);
        // }
    });

    messaging.onMessage((payload) => {
        $('#notification-numbers').text(payload?.data?.count ?? 0);
    });

</script>
@endsection