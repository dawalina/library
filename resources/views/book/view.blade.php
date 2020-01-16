@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Edit book') }}</div>
                <div class="card-body">
                    {{ Form::open(['route' => ['book.edit', $item->id]]) }}
                        {{ Form::model($item, array('route' => array('book.edit', $item->id))) }}

                        <div class="row">
                            {{ Form::label('title', 'Title', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('title', Null, [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('category_id', 'Category', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::select('category_id', \App\Models\Category::pluck('name','id'), null, [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="row">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Copies') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">ID</div>
                        <div class="col-sm">Status</div>
                        <div class="col-sm">Created at</div>
                        <div class="col-sm">Updated at</div>
                        <div class="col-sm">Action</div>
                    </div>
                    @foreach($items as $copy)
                        <div class="row">
                            <div class="col-sm">{{ $copy->id }}</div>
                            <div class="col-sm">{{ $statuses[$copy->status] }}</div>
                            <div class="col-sm">{{ $copy->created_at }}</div>
                            <div class="col-sm">{{ $copy->updated_at }}</div>
                            <div class="col-sm">
                                @if ($copy->status === 0)
                                    <a class="btn-link" href="{{ route('book.copy.remove', [
                                            'id'     => $item->id,
                                            'copyId' => $copy->id,
        ]                               ) }}">
                                        {{ __('Remove') }}
                                    </a>
                                @else
                                    <a class="btn-link" href="{{ route('book.copy.add', [
                                            'id'     => $item->id,
                                            'copyId' => $copy->id,
        ]                               ) }}">
                                        {{ __('Add') }}
                                    </a>
                                @endif
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
                    'route' => ['book.copy.create', $item->id],
                    'class' => 'form-inline'
                ]) }}
                    {{ Form::label('count', 'Count', [
                        'class' => 'form-control-label col-md-3'
                    ]) }}
                    {{ Form::number('count', '1', [
                        'class' => 'form-control col-md-3'
                    ]) }}
                    {{ Form::submit('Create', ['class' => 'btn btn-primary col-md-3']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
