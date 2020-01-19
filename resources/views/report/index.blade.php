@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Rents') }}</div>

                <div class="card-header">
                    {{ Form::open([
                        'route' => ['report.index']
                    ]) }}
                    <div class="form-group row">
                        {{ Form::label('reader_id', 'Reader', [
                            'class' => 'form-control-label col-md-3'
                        ]) }}
                        <select name="reader_id" class="form-control col-md-6">
                            <option value="0"
                                @if ($reader_id == 0)
                                    selected
                                @endif
                            >
                                {{ __('All')  }}
                            </option>
                            @foreach ($readers as $reader)
                                <option value="{{ $reader->id }}"
                                    @if ($reader_id == $reader->id)
                                        selected
                                    @endif
                                >
                                    {{ $reader->last_name }} {{ $reader->first_name }} {{ $reader->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('category_id', 'Category', [
                            'class' => 'form-control-label col-md-3'
                        ]) }}
                        <select name="category_id" class="form-control col-md-6">
                            <option value="0"
                                @if ($category_id == 0)
                                    selected
                                @endif
                            >
                                {{ __('All')  }}
                            </option>
                            @foreach ($categories as $id => $category)
                                <option value="{{ $id }}"
                                    @if ($category_id == $id)
                                        selected
                                    @endif
                                >
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('period', 'Issued period', [
                            'class' => 'form-control-label col-md-3'
                        ]) }}
                        {{ Form::text('period', $period, [
                            'class' => 'form-control col-md-3 date-range'
                        ]) }}
                    </div>

                    {{ Form::submit('Search', ['class' => 'btn btn-primary col-md-3']) }}
                    {{ Form::close() }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">ID</div>
                        <div class="col-sm">Reader</div>
                        <div class="col-sm">Copy</div>
                        <div class="col-sm">Issued at</div>
                        <div class="col-sm">Expire at</div>
                        <div class="col-sm">Returned at</div>
                        <div class="col-sm">Status</div>
                        <div class="col-sm">Created at</div>
                        <div class="col-sm">Updated at</div>
                        <div class="col-sm">Action</div>
                    </div>
                    @foreach($items as $item)
                        <div class="row">
                            <div class="col-sm">{{ $item->id }}</div>
                            <div class="col-sm">
                                {{ $item->reader_last_name }} {{ $item->reader_first_name }}
                            </div>
                            <div class="col-sm">
                                {{ $item->copy_id }}
                            </div>
                            <div class="col-sm">{{ $item->issued_at }}</div>
                            <div class="col-sm">{{ $item->expire_at }}</div>
                            <div class="col-sm">{{ $item->returned_at }}</div>
                            <div class="col-sm">{{ $statuses[$item->status] }}</div>
                            <div class="col-sm">{{ $item->created_at }}</div>
                            <div class="col-sm">{{ $item->updated_at }}</div>
                            <div class="col-sm">
                                <a class="btn-link" href="{{ route('rent.view', [
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
        </div>
    </div>
</div>
@endsection

<script>
    window.addEventListener('load', function() {
        $(function(){
            $('input.date-range').daterangepicker({
                'locale': {
                    'format': 'YYYY-MM-DD'
                }
            });
        });
    });
</script>
