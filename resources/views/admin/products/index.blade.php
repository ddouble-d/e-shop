@extends('layouts.admin.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Products</h2>
                    @can('add_products')
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary">+ Add New</a>
                    @endcan
                </div>
                <div class="card-body">
                    @include('flash.messages')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th width="5%">#</th>
                            <th>SKU</th>
                            <th>Type</th>
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
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ $product->status_label() }}</td>
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
