@extends('admin.layouts.default')

@section('admin.content')
    <table class="table table-bordered table-condensed table-responsive table-striped">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Impersonate</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->avatar)
                            <img src="/images/avatars/{{ $user->avatar }}" alt="Users avatar" class="user-avatar">
                        @endif
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        <a href="">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td>
                        {{ $user->created_at->format('m/d/Y H:i:s') }}
                    </td>
                    <td>
                        @if(auth()->user()->id !== $user->id)
                        <form action="{{ route('admin.impersonate', $user->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-xs btn-info">
                                <i class="fa fa-sign-in"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->render() }}
@endsection