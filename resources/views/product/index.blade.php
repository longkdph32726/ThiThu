@extends('master')
@section('title')
    Danh sách
@endsection
@section('content')

<a href="{{ route('products.create') }}" class="btn btn-info">Thêm mới</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Tags</th>
            <th>Action</th>
        </tr>
        @foreach ($data as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @if ($product->image_path && \Storage::exists($product->image_path))
                        <img src="{{ \Storage::url($product->image_path) }}" width="100px" alt="">
                    @endif
                </td>
                <td>{{ number_format($product->price) }}</td>
                <td>
                    @foreach ($product->tags as $item)
                    {{ $item->name }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('products.edit',$product) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('products.destroy',$product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirm('Có chắc không!')" class="btn btn-warning">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $data->links() }}
@endsection