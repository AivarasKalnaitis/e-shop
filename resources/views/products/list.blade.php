@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Products
                        <a class="btn btn-sm btn-primary float-right" href="{{ route('products.create') }}">+</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ $item->getFirstImageUrl() }}" width="70">
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td></td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $list->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection