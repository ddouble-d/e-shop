@extends('layouts.admin.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Categories</h2>
                    <a href="{{ url('admin/categories/create') }}" class="btn btn-primary">+ Add New</a>
                </div>
                <div class="card-body">
                    @include('flash.messages')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @forelse ($categories as $category)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent_id ? $category->parent->name : '' }}</td>
                                <td>
                                    <a href="{{ url('admin/categories/'.$category->id.'/edit') }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    {{ Form::open(['url' => 'admin/categories/'.$category->id, 'class' => 'delete',
                                    'style' => 'display:inline-block'])
                                    }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
