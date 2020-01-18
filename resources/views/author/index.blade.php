@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Authors') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">ID</div>
                        <div class="col-sm">Last name</div>
                        <div class="col-sm">First name</div>
                        <div class="col-sm">Created at</div>
                        <div class="col-sm">Updated at</div>
                        <div class="col-sm">Action</div>
                    </div>
                    @foreach($items as $item)
                        <div class="row">
                            <div class="col-sm">{{ $item->id }}</div>
                            <div class="col-sm">{{ $item->last_name }}</div>
                            <div class="col-sm">{{ $item->first_name }}</div>
                            <div class="col-sm">{{ $item->created_at }}</div>
                            <div class="col-sm">{{ $item->updated_at }}</div>
                            <div class="col-sm">
                                <a class="btn-link" href="{{ route('author.view', [
                                    'id' => $item->id
]                               ) }}">
                                    {{ __('View') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                {{ $items->links() }}
            </div>
            <div class="card-footer">
                {{ Form::open([
                    'route' => ['author.create']
                ]) }}
                <div class="form-group row">
                    {{ Form::label('first_name', 'First name', [
                        'class' => 'form-control-label col-md-3'
                    ]) }}
                    {{ Form::text('first_name', '', [
                        'class' => 'form-control col-md-3'
                    ]) }}
                </div>
                <div class="form-group row">
                    {{ Form::label('last_name', 'Last name', [
                        'class' => 'form-control-label col-md-3'
                    ]) }}
                    {{ Form::text('last_name', '', [
                        'class' => 'form-control col-md-3'
                    ]) }}
                </div>
                {{ Form::submit('Create', ['class' => 'btn btn-primary col-md-3']) }}
            </div>
            {{ Form::close() }}
        </div>
        </div>
    </div>
</div>
@endsection
