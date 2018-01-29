@extends('admin.layouts.default')

@section('admin.content')

    <div class="ACCOUNT-FILE-FORM">
        <div class="HEADER-BOX">
            create a file category
        </div>
        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="col-sm-12 no-padding YOUR-FILE-BOX YOUR-FILEBOX-CRUD">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>File Category Name</label>
                    <input type="text" name="name" class="form-control">
                    @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <br />

                <div class="form-group pull-right">
                    <a href="{{ route('admin.categories') }}" class="btn btn-danger">Back</a> &nbsp;
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <span class="visible-xs"><br /><br /></span>
            </div>
        </form>
    </div>

@endsection