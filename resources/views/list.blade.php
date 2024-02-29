@extends('layouts.app')

@section('content')
<div class="container">
    <div class="products_list">
        <div class="list_title">商品一覧画面</div>

        <!-- 検索機能ここから -->
    <div class="search_wrap">
    <form action="{{ route('list') }}" method="GET">
    @csrf
        <input class="search_text search_content" type="text" name="keyword" value="{{ $search['keyword'] }}"  placeholder="検索キーワード">
        <select class="search_company search_content" name="company_id" >
                        <option value="">メーカー名</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $search['company_id'] == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
        <input class="search_btn" type="submit" value="検索">
    </form>
    </div>
        <table class="list_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th><button type="button" class="new_product_btn" onclick="location.href='{{ route('productregist') }}'">新規登録</button></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr class="list_tr">
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset($product->img_path) }}" height="100px" alt="商品画像"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <button type="button" class="detail_btn" onclick="location.href='{{ route('detail', ['id' => $product->id, 'search' => session('search')]) }}'">詳細</button>
                        <form class="delete_area" action="{{ route('product.delete', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="delete_btn">削除</button>
                        </form>
                        @if(session('success'))
                        <div class="alert alert-success">

                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
