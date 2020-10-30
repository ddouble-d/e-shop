@extends('layouts.admin.app')
@section('content')

<div class="content">
    <div class="row">
        @include('admin.products.product_menus')
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Product Images</h2>
                    <a href="{{ url('admin/products/'.$productID.'/add-image') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body">
                    @include('flash.messages')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>#</th>
                            <th>Image</th>
                            <th>Uploaded At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($productImages as $image)
                            <tr>
                                <td>{{ $image->id }}</td>
                                <td><img src="{{ asset('storage/'.$image->path) }}" style="width:150px" /></td>
                                <td>{{ $image->created_at }}</td>
                                <td>
                                    {!! Form::open(['url' => 'admin/products/images/'. $image->id, 'class' => 'delete',
                                    'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
