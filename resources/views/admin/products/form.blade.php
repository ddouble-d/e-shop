@extends('layouts.admin.app')
@section('content')

@php
$formTitle = !empty($category) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @if (!empty($product))
                    {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    @else
                    {!! Form::open(['url' => 'admin/products']) !!}
                    @endif
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
                            @error('sku')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-8">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name'])
                            !!}
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-8">
                            {!! Form::label('category_ids', 'Category') !!}
                            {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control',
                            'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') :
                            $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
                            @error('category_ids')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('short_description', 'Short Description') !!}
                        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' =>
                        'short description', 'rows' => 3]) !!}
                        @error('short_description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' =>
                        'description', 'rows' => 6]) !!}
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            {!! Form::label('weight', 'Weight') !!}
                            {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'weight']) !!}
                            @error('weight')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('length', 'Length') !!}
                            {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'length']) !!}
                            @error('length')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('width', 'Width') !!}
                            {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'width']) !!}
                            @error('width')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            {!! Form::label('height', 'Height') !!}
                            {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'height']) !!}
                            @error('height')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '--
                        Set Status --']) !!}
                        @error('status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
