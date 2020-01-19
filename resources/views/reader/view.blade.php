@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Edit reader') }}</div>
                <div class="card-body">
                    {{ Form::open(['route' => ['reader.edit', $item->id]]) }}
                        {{ Form::model($item, array('route' => array('reader.edit', $item->id))) }}

                        <div class="row">
                            {{ Form::label('last_name', 'Last name', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('last_name', Null, [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('first_name', 'First name', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::text('first_name', Null, [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            {{ Form::label('email', 'E-mail', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <div class="col-md-8">
                                {{ Form::email('email', Null, [
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
                <div class="card-header">{{ __('Rents') }}</div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
