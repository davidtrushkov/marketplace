@extends('layouts.plain')

@section('content')
    <div id="SINGLE-FILE-SHOW">
        <div class="container-fluid no-padding SINGLE-FILE-HEADER">
            <div class="container">
                @include('layouts.partials._flash')
                <div class="col-sm-4">
                    <img src="/images/files/cover/{{ isset($file->avatar) ? $file->avatar : '' }}" alt="{{ $file->title }} cover image" class="SINGLE-FILE-COVER-IMAGE" />

                    <div class="SINGLE-FILE-CART-BOX">
                        @if($file->isFree())
                            <h3>FREE</h3>
                            @include('files.partials._checkout_form_free')
                        @else
                            <h3>${{ $file->price }}</h3>
                        @endif

                        @if(!$file->isFree())
                            <form>
                                <button type="submit" class="btn btn-primary">Buy Now</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <h4>
                       {{ $file->user->name }} is selling
                    </h4>
                    <h1>{{ $file->title }}</h1>
                    <div class="SINGLE-FILE-OVERVIEW-SHORT">
                        {{ $file->overview_short }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container SINGLE-FILE-CONTENT">
            <div class="col-sm-8">
                <p>{!! $file->overview !!}</p>
            </div>
            <div class="col-sm-4">
                @foreach($uploads as $upload)
                    <p>{{ $upload->filename }}</p>
                    <small>{{ $file->size }}</small>
                @endforeach
            </div>
        </div>
    </div>
@endsection