@extends('account.layouts.default')

@section('account.content')
    @if($filesSold->count() > 0)
        @foreach($filesSold as $sold)
            <div id="ACCOUNT-YOUR-FILES">
                <div class="YOUR-FILE-BOX col-sm-12 no-padding">
                    <div class="col-sm-12 no-padding">
                        <a href="{{ route('files.show', $sold->file) }}">
                            <div class="col-sm-12 no-padding">
                                <div class="col-sm-3">
                                    <h4><span class="label label-success">Sold</span></h4>
                                </div>
                                <div class="col-sm-9">
                                    <h5>{{ $sold->file->title }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="col-sm-3">
                                    <h4><span class="label label-success">Date</span></h4>
                                </div>
                                <div class="col-sm-9">
                                    <h5>{{ $sold->created_at->format('m/d/Y') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="col-sm-3">
                                    <h4><span class="label label-success">Price</span></h4>
                                </div>
                                <div class="col-sm-9">
                                    <h5>
                                        @if($sold->sale_price > 0)
                                            ${{ $sold->sale_price }} / <small>Commission: ${{ $sold->sale_commission }}</small>
                                            / <small>You got: ${{ $got = number_format($sold->sale_price - $sold->sale_commission, 2) }}</small>
                                        @else
                                            Free Download
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="col-sm-3">
                                    <h4><span class="label label-success">Bought By</span></h4>
                                </div>
                                <div class="col-sm-9">
                                    @if($sold->boughtUser->pluck('name')->count() > 0)
                                        <?php $strings = array('[', ']', '"', '"'); ?>
                                        <h5>{{ str_replace($strings, '', $sold->boughtUser->pluck('name')) }}</h5>
                                    @else
                                        <code>Bought by guest user</code>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {!! $filesSold->render() !!}
    @else
        <p>You have no sales on this account yet.</p>
    @endif

@endsection