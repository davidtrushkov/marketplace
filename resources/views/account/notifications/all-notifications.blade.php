@extends('account.layouts.default')

@section('account.content')
    <div id="ACCOUNT-NOTIFICATION">
        <div>

            <ul class="nav nav-tabs">
                <li role="presentation" class="{{ isActiveRoute('get.unread.notifications') }}"><a href="{{ route('get.unread.notifications') }}">Unread Notifications</a></li>
                <li role="presentation" class="{{ isActiveRoute('get.all.notifications') }}"><a href="{{ route('get.all.notifications') }}">All Notifications</a></li>
            </ul>

            <br />
            @if($notifications->count() > 0)
                @foreach($notifications as $allNotifications)
                    <div class="media media-content">
                        <div class="media-left">
                            <a href="{{ route('show.notification', $allNotifications->id) }}">
                                <img class="media-object user-avatar"
                                     src="{{ isset($allNotifications->data['owner_avatar']) ? '/images/files/cover/'.$allNotifications->data['owner_avatar'] : '/images/icons/avatar.svg' }}"
                                     alt="{{ isset($allNotifications->data['owner_name']) ? $allNotifications->data['owner_name'] : 'Avatar Image' }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $allNotifications->data['header'] }}</h4>
                            <span class="hidden-xs">{{ str_limit($allNotifications->data['data'], 80) }}</span> <a href="{{ route('show.notification', $allNotifications->id) }}">Read more...</a>
                            <div>
                                <br />
                                @if(isset($allNotifications->data['owner_name']))
                                    <span>From: {{ $allNotifications->data['owner_name'] }}</span>
                                @endif
                                <small class="pull-right">{{ $allNotifications->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $notifications->render() }}
            @else
                <p>You have no notifications</p>
            @endif
        </div>

    </div>
@endsection