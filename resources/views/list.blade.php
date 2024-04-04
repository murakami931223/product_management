@extends('layouts.app')

@section('content')
<div class="container">
    <div class="products_list">
        <div class="list_title">商品一覧画面</div>

    <!-- 検索機能ここから -->
    <form action="{{ route('list') }}" method="GET" >
    @csrf
        <table class="search_table">
            <tbody>
                <tr>
                    <th class="width_a"><input class="search_text search_content" type="text" name="keyword" value="{{ $search['keyword'] }}"  placeholder="検索キーワード"></th>
                    <th class="width_a">
                        <select class="search_company search_content" name="company_id" >
                        <option value="">メーカー名</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $search['company_id'] == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                        </select>
                    </th>
                    <th class="width_b">
                        <div class="flex">
                        <input class="search_lower_price search_content" type="number" name="lower_price" value="{{ $search['lower_price'] }}"  placeholder="下限価格">
                        <p>～</p>
                        <input class="search_upper_price search_content" type="number" name="upper_price" value="{{ $search['upper_price'] }}"  placeholder="上限価格">
                        </div>
                    </th>
                    <th class="width_b">
                        <div class="flex">
                        <input class="search_lower_stock search_content" type="number" name="lower_stock" value="{{ $search['lower_stock'] }}"  placeholder="下限在庫">
                        <p>～</p>
                        <input class="search_upper_stock search_content" type="number" name="upper_stock" value="{{ $search['upper_stock'] }}"  placeholder="上限在庫">
                        </div>
                    </th>
                    <th><input class="search_btn" type="submit" value="検索"></th>
                </tr>
            </tbody>
        </table>
    </form>


    <!-- 商品一覧ここから -->
    <div id="table_wrap">
        <table class="list_table" id="list_table">
            <thead>
                <tr>
                    <th class="hover_change">ID</th>
                    <th class="hover_change">商品画像</th>
                    <th class="hover_change">商品名</th>
                    <th class="hover_change">価格</th>
                    <th class="hover_change">在庫数</th>
                    <th class="hover_change">メーカー名</th>
                    <th><button type="button" class="new_product_btn" onclick="location.href='{{ route('productregist') }}'">新規登録</button></th>
                </tr>
            </thead>

            <tbody id="list_tbody">
            @foreach ($products as $product)
                <tr class="list_tr">
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset($product->img_path) }}" height="100px" alt="商品画像"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <button  type="button" class="detail_btn" onclick="location.href='{{ route('detail', ['id' => $product->id, 'search' => session('search')]) }}'">詳細</button>
                        <form class="delete_area" action="{{ route('product.delete', ['deleteID' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button data-product_id="{{$product->id}}" type="button" class="delete_btn">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->appends(request()->query())->links() }}
    </div>
    </div>
</div>
@endsection
