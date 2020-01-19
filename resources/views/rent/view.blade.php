@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Edit rent') }}</div>
                <div class="card-body">
                    {{ Form::open(['route' => ['rent.edit', $item->id]]) }}
                        {{ Form::model($item, array('route' => array('rent.edit', $item->id))) }}


                        <div class="form-group row">
                            {{ Form::label('reader_id', 'Reader', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <select name="reader_id" class="form-control col-md-6">
                                @foreach ($readers as $reader)
                                    <option value="{{ $reader->id }}"
                                        @if ($reader->id == $item->reader_id))
                                            selected="selected"
                                        @endif
                                    >{{ $reader->last_name }} {{ $reader->first_name }} {{ $reader->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('copy_id', 'Book', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            <select name="copy_id" class="form-control col-md-6">
                                @foreach ($books as $book)
                                    @if ($item->copy->book_id === $book->id)
                                        <option value="{{ $item->copy_id }}" selected="selected">
                                    @elseif (isset($enabledCopies[$book->id]))
                                        <option value="{{ $enabledCopies[$book->id][0] }}">
                                    @else
                                        <option value="0_{{$book->id}}" disabled>
                                    @endif
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('issued_at', 'Issued at', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            {{ Form::text('issued_at', null, [
                                'class' => 'form-control col-md-3'
                            ]) }}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('expire_at', 'Expire at', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            {{ Form::text('expire_at', null, [
                                'class' => 'form-control col-md-3'
                            ]) }}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('returned_at', 'Returned at', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            {{ Form::text('returned_at', null, [
                                'class' => 'form-control col-md-3'
                            ]) }}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('status', 'Status', [
                                'class' => 'form-control-label col-md-3'
                            ]) }}
                            {{ Form::select('status', $statuses, $item->status, [
                                'class' => 'form-control col-md-3'
                            ]) }}
                        </div>
                        <div class="row">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
