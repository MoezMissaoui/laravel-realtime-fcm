@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary">
                        Notifications 
                        <span class="badge badge-light" id="notification-numbers">
                            {{ $notifications->count() }}
                        </span>
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table" id="table-notifications">
                            <caption>List of Notifications</caption>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Content</th>
                                <th scope="col">User</th>
                                <th scope="col">Created AT</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <th> {{ $notification->id }} </th>
                                        <td> {{ $notification->content }} </td>
                                        <td> {{ $notification->user_id }} </td>
                                        <td> {{ $notification->created_at }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>


    messaging.onMessage((payload) => {
        $('#notification-numbers').text(payload?.data?.count ?? 0);

        var date = new Date(payload?.data?.created_at);
        date = date.getFullYear()+
                    "-"+( (date.getMonth().toString().length < 2) ? '0'+date.getMonth() : date.getMonth())+
                    "-"+( (date.getDate().toString().length < 2) ? '0'+date.getDate() : date.getDate())+

                    " "+date.getHours()+
                    ":"+( (date.getMinutes().toString().length < 2) ? '0'+date.getMinutes() : date.getMinutes())+
                    ":"+( (date.getSeconds().toString().length < 2) ? '0'+date.getSeconds() : date.getSeconds());

        $('#table-notifications tbody').prepend(
            `
            <tr>
                <th> `+ (payload?.data?.id ?? '') + ` </th>
                <td> `+ (payload?.data?.content ?? '') + ` </td>
                <td> `+ (payload?.data?.user_id ?? '') + ` </td>
                <td> `+ date + ` </td>
            </tr>
            `
        );
    });


</script>
@endsection