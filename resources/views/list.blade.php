@extends('layouts.app')

@section('content')
<div class="container">
    <div class="items_list">
        <div class="list_title">商品一覧画面</div>

        <!-- 検索機能ここから -->
    <div class="search_wrap">
    <form action="{{ route('list') }}" method="GET">
    @csrf
        <input class="search_text search_content" type="text" name="keyword" value="{{$keyword}}"  placeholder="検索キーワード">
        <select class="search_maker search_content" name="maker_name" >
                        <option value="">メーカー名</option>
                        <option value="Coca-Cola" {{ old('Coca-Cola') === 'Coca-Cola' ? 'selected' : '' }}>Coca-Cola</option>
                        <option value="サントリー" {{ old('サントリー') === 'サントリー' ? 'selected' : '' }}>サントリー</option>
                        <option value="キリン" {{ old('キリン') === 'キリン' ? 'selected' : '' }}>キリン</option>
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
                    <th><button type="button" class="new_item_btn" onclick="location.href='{{ route('itemregist') }}'">新規登録</button></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr class="list_tr">
                    <td>{{ $item->id }}</td>
                    <td><img src="{{ asset($item->items_img) }}" height="100px" alt="商品画像"></td>
                    <td>{{ $item->items_name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->items_stock }}</td>
                    <td>{{ $item->maker_name }}</td>
                    <td>
                        <button type="button" class="detail_btn" onclick="location.href='{{ route('detail', ['id' => $item->id]) }}'">詳細</button>
                        <form class="delete_area" action="{{ route('item.delete', ['item' => $item->id]) }}" method="POST">
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
        {{ $items->links() }}
    </div>
</div>
@endsection
