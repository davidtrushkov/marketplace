@extends('admin.layouts.default')

@section('admin.content')

    <div class="col-sm-12 no-padding">
        <a href="{{ route('admin.category.create') }}" class="btn btn-info">Create Category</a>
        <br /><br /><br />
    </div>

    <table class="table table-bordered table-condensed table-responsive table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->slug) }}" class="btn btn-xs btn-info">
                        <i class=" fa fa-pencil"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $categories->render() }}

@endsection