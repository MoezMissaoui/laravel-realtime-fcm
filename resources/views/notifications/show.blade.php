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
                        <table class="table">
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



</script>
@endsection