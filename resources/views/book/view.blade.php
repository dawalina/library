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
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection
