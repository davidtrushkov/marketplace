@extends('account.layouts.default')

@section('account.content')
    @if(\App\Sale::boughtUserId()->count() > 0)
        @foreach($boughtFiles as $bought)
            <div id="ACCOUNT-YOUR-FILES">
                <div class="YOUR-FILE-BOX col-sm-12 no-padding">
                    <div class="col-sm-12 no-padding">
                        <a href="{{ route('files.show', $bought->file) }}">
                            <div class="col-sm-3 no-padding">
                                <img src="{{ isset($bought->file->avatar) ? '/images/files/cover/'.$bought->file->avatar : '/images/home/default.png' }}" alt="{{ $bought->title }} cover image" width="100%" />
                            </div>
                            <div class="col-sm-9">
                                <h4><i>Purchased:</i> {{ $bought->file->title }}</h4>
                                <h5>for <b>${{ $bought->sale_price }}</b><div class="pull-right">On: {{ $bought->created_at->format('m/d/Y') }}</div></h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <br />
                        <a href="{{ route('files.show', $bought->file) }}">
                            <p>{{ str_limit($bought->file->overview_short, 150) }}</p>
                        </a>
                        <p>By: {{ $bought->file->user->name }}</p>
                        <a href="{{ route('files.download', [$bought->file, $bought]) }}">
                            Download your file
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {!! $boughtFiles->render() !!}
    @else
        <p>You have not purchased any files on this account yet.</p>
    @endif

@endsection