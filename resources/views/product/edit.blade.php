@extends('master')
@section('title')
    Sửa sp
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success">
        {{  session()->get('success')}}
    </div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger">{{ session()->get('error') }}</div>
    
@endif

    <form action="{{ route('products.update',$product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label class="mt-3">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $id => $item)
            
                <option
                @selected($product->category_id == $id)
                value="{{ $id }}">{{ $item }}</option>
            @endforeach
        </select>

        <label class="mt-3">Name</label>
        <input class="form-control" type="text" name="name" value="{{ $product->name }}">

        <label class="mt-3">Image</label>
        <input class="form-control" type="file" name="image_path">
        @if ($product->image_path && \Storage::exists($product->image_path))
        <img src="{{ \Storage::url($product->image_path) }}" width="100px" alt="">
        @endif
        <br>

        <label for="price" class="mt-3">price</label>
        <input class="form-control" type="text" name="price" value="{{ $product->price }}">

        
        <label for="description" class="mt-3">Description</label>
        <textarea class="form-control" type="text" name="description" >{{ $product->description }}</textarea>

        <label class="mt-3">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            @foreach ($tags as $id => $item)
                <option
                @selected(in_array($id,$productTags))
                value="{{ $id }}">{{ $item }}</option>
            @endforeach
        </select>
        
        @foreach ($product->galleries as $key => $item)
            <label for="gallery_{{ $key }}" class="mt-3">Gallery {{ $key }}</label>
            <input class="form-control" type="file" name="galleries[{{ $item->id }}]">
            @if ($item->image_path && \Storage::exists($item->image_path))
            <img src="{{ \Storage::url($item->image_path) }}" width="100px" alt="">
            @endif
        @endforeach

<hr>

        <button type="submit" class="btn btn-danger mt_3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-success">Danh sách</a>
    </form>
@endsection