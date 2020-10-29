@extends('layouts.admin.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Products</h2>
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary">+ Add New</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th width="5%">#</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->status }}</td>
                                <td>
                                    <a href="{{ url('admin/products/'. $product->id .'/edit') }}"
                                        class="btn btn-warning btn-sm">Edit</a>

                                    {!! Form::open(['url' => 'admin/products/'. $product->id, 'class' => 'delete',
                                    'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
