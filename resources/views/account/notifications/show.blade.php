@extends('account.layouts.default')

@section('account.content')
    <div id="ACCOUNT-NOTIFICATION">

        <div class="media media-content">
            <div class="media-left">
                <a href="#">
                    <img class="media-object user-avatar"
                         src="{{ isset($notification->data['owner_avatar']) ? '/images/files/cover/'.$notification->data['owner_avatar'] : '/images/icons/avatar.svg' }}"
                         alt="{{ isset($notification->data['owner_name']) ? $notification->data['owner_name'] : 'Avatar Image' }}">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{ $notification->data['header'] }}</h4><br />
                <p>{{ $notification->data['data'] }}</p>
                <div>
                    <br />
                    @if(isset($notification->data['owner_name']))
                        <span>From: {{ $notification->data['owner_name'] }}</span>
                    @endif
                    <small class="pull-right">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <div class="col-sm-12 no-padding">
            <br />
            @if($notification->read_at === null)
                <a href="{{ route('notification.mark.as.read', $notification->id) }}" class="btn btn-primary pull-right">Mark as Read</a>
            @endif
            <a href="{{ route('get.all.notifications') }}" class="btn btn-danger pull-right" @if($notification->read_at === null)style="margin-right: 15px;"@endif>Go Back</a>
        </div>

    </div>
@endsection