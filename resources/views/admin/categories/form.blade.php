@extends('layouts.admin.app')
@section('content')

@php
$formTitle = !empty($category) ? 'Update' : 'New';
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Category</h2>
                </div>
                <div class="card-body">
                    @if (!empty($category))
                    {{ Form::model($category, ['url' => ['admin/categories', $category->id], 'method' => 'PUT']) }}
                    {{ Form::hidden('id') }}
                    @else
                    {{ Form::open(['url' => 'admin/categories']) }}
                    @endif
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category Name']) }}
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('parent_id', 'Parent') }}
                        {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'selected'
                        => !empty(old('parent_id')) ? old('parent_id') : (!empty($category['parent_id']) ?
                        $category['parent_id'] : ''), 'placeholder' => '-- Choose Category --']) !!}
                        @error('parent_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/categories') }}" class="btn btn-secondary">Back</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
