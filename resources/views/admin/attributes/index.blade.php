@extends('layouts.admin.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Attributes</h2>
                    <a href="{{ url('admin/attributes/create') }}" class="btn btn-primary">+ Add New</a>
                </div>
                <div class="card-body">
                    @include('flash.messages')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @forelse ($attributes as $attribute)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $attribute->code }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->type}}</td>
                                <td>
                                    <a href="{{ url('admin/attributes/'.$attribute->id.'/edit') }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    @if ($attribute->type == 'select')
                                    <a href="{{ url('admin/attributes/'. $attribute->id .'/options') }}"
                                        class="btn btn-success btn-sm">Options</a>
                                    @endif
                                    {{ Form::open(['url' => 'admin/attributes/'.$attribute->id, 'class' => 'delete',
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
                {{ $attributes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
