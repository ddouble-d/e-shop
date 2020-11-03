@extends('layouts.admin.app')
@section('content')

@php
$formTitle = !empty($category) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        @include('admin.products.product_menus')
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @if (!empty($product))
                    {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('type') !!}
                    @else
                    {!! Form::open(['url' => 'admin/products']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type', $types , !empty($product) ? $product->type : null, ['class' =>
                        'form-control product-type', 'placeholder' => '-- Choose Product Type --', 'disabled' =>
                        !empty($product)]) !!}
                        @error('type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('sku', 'SKU') !!}
                        {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
                        @error('sku')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name'])
                        !!}
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_ids', 'Category') !!}
                        {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control',
                        'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') :
                        $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
                        @error('category_ids')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="configurable-attributes">
                        @if (!empty($configurableAttributes) && empty($product))
                        <p class="text-primary mt-4">Configurable Attributes</p>
                        <hr />
                        @foreach ($configurableAttributes as $attribute)
                        <div class="form-group">
                            {!! Form::label($attribute->code, $attribute->name) !!}
                            {!! Form::select($attribute->code. '[]', $attribute->attributeOptions->pluck('name','id'),
                            null, ['class' => 'form-control', 'multiple' => true]) !!}
                            @error($attribute->code)
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                        @endif
                    </div>

                    @if ($product)
                    @if ($product->type == 'configurable')
                    @include('admin.products.configurable')
                    @else
                    @include('admin.products.simple')
                    @endif

                    <div class="form-group">
                        {!! Form::label('short_description', 'Short Description') !!}
                        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' =>
                        'short description']) !!}
                        @error('short_description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' =>
                        'description']) !!}
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '--
                        Set Status --']) !!}
                        @error('status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif
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
