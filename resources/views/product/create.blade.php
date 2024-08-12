@extends('master')
@section('title')
    Thêm mới
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

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="mt-3">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $id => $item)
                <option value="{{ $id }}">{{ $item }}</option>
            @endforeach
        </select>

        <label class="mt-3">Name</label>
        <input class="form-control" type="text" name="name">

        <label class="mt-3">Image</label>
        <input class="form-control" type="file" name="image_path">

        <label for="price" class="mt-3">price</label>
        <input class="form-control" type="text" name="price">

        
        <label for="description" class="mt-3">Description</label>
        <textarea class="form-control" type="text" name="description"></textarea>

        <label class="mt-3">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            @foreach ($tags as $id => $item)
                <option value="{{ $id }}">{{ $item }}</option>
            @endforeach
        </select>
        
        <label for="gallery_1" class="mt-3">Gallery 1</label>
        <input class="form-control" type="file" name="galleries[]">

        <label for="gallery_2" class="mt-3">Gallery 2</label>
        <input class="form-control" type="file" name="galleries[]">

        <button type="submit" class="btn btn-danger mt_3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-success">Danh sách</a>
    </form>
@endsection