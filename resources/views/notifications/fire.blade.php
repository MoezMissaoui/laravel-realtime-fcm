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
        return axios.post("{{  route('store-notification') }}").then(res => {
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

    // Initialize Firebase Cloud Messaging and get a reference to the service
    const messaging = firebase.messaging();
    messaging.usePublicVapidKey('BNQPQsfA6L1PTdtRrn1djQAQXM90ivedxBXjHv-uJNKKllJasSJWL3UK_9W6mtLFF2cHGBbByxKH31cqNrP8Fs0');
    function store_fcmtoken(token) {
        return axios.post("{{  route('store-fcmtoken') }}", {
            token
        }).then(res => {
            return res.data.data.notif;
        })
    }
    function retreiveToken() {
        // Get registration token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.getToken().then((currentToken) => {
            if (currentToken) {
                // Send the token to your server and update the UI if necessary
                store_fcmtoken(currentToken)
            } else {
                alert('You should allow notifications!');
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });
    }
    messaging.onTokenRefresh(() => {
        retreiveToken();
    });
    retreiveToken();
    messaging.onMessage((payload) => {
        $('#notification-numbers').text(payload?.data?.count);
    });

</script>
@endsection