@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">ID</div>
                        <div class="col-sm">Title</div>
                        <div class="col-sm">Category</div>
                        <div class="col-sm">Release date</div>
                        <div class="col-sm">Created at</div>
                        <div class="col-sm">Updated at</div>
                        <div class="col-sm">Action</div>
                    </div>
                    @foreach($items as $item)
                        <div class="row">
                            <div class="col-sm">{{ $item->id }}</div>
                            <div class="col-sm">{{ $item->title }}</div>
                            <div class="col-sm">{{ $item->name }}</div>
                            <div class="col-sm">{{ $item->release_date }}</div>
                            <div class="col-sm">{{ $item->created_at }}</div>
                            <div class="col-sm">{{ $item->updated_at }}</div>
                            <div class="col-sm">
                                <a class="btn-link" href="{{ route('book.view', [
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
