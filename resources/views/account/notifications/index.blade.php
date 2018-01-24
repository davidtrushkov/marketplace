@extends('account.layouts.default')

@section('account.content')
    <div id="ACCOUNT-NOTIFICATION">
        <div>

            <ul class="nav nav-tabs">
                <li role="presentation" class="{{ isActiveRoute('get.unread.notifications') }}"><a href="{{ route('get.unread.notifications') }}">Unread Notifications</a></li>
                <li role="presentation" class="{{ isActiveRoute('get.all.notifications') }}"><a href="{{ route('get.all.notifications') }}">All Notifications</a></li>
            </ul>

            <br />
            @if($unreadNotifications->count() > 0)
                <a href="{{ route('notifications.mark.all.as.read') }}">Mark All as Read</a>

                @foreach($unreadNotifications as $unread)
                    <div class="media media-content">
                        <div class="media-left">
                            <a href="{{ route('show.notification', $unread->id) }}">
                                <img class="media-object user-avatar"
                                     src="{{ isset($unread->data['owner_avatar']) ? '/images/files/cover/'.$unread->data['owner_avatar'] : '/images/icons/avatar.svg' }}"
                                     alt="{{ isset($unread->data['owner_name']) ? $unread->data['owner_name'] : 'Avatar Image' }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $unread->data['header'] }}</h4>
                            {{ str_limit($unread->data['data'], 80) }} <a href="{{ route('show.notification', $unread->id) }}">Read more...</a>
                            <div>
                                <br />
                                @if(isset($unread->data['owner_name']))
                                    <span>From: {{ $unread->data['owner_name'] }}</span>
                                @endif
                                <small class="pull-right">{{ $unread->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $unreadNotifications->render() }}
            @else
                <p>You have no unread notifications</p>
            @endif
        </div>
    </div>
@endsection