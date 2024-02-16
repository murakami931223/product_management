@extends('layouts.app')

@section('content')
<div class="row">
            <div class="detail_title">商品詳細画面</div>
            <div class="detail_wrap">
                <table>
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">ID.</th>
                        <td class="detail_td detail_row">{{ $item->id }}</td>
                    </tr>

                    <tr class="detail_tr">
                        <th class="detail_th detail_row">商品画像</th>
                        <td class="detail_td detail_row"><img src="{{ asset($item->items_img) }}" height="100px" alt="商品画像"></td>
                        
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">商品名</th>
                        <td class="detail_td detail_row">{{ $item->items_name }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">メーカー名</th>
                        <td class="detail_td detail_row">{{ $item->maker_name }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">価格</th>
                        <td class="detail_td detail_row">{{ $item->price }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">在庫数</th>
                        <td class="detail_td detail_row">{{ $item->items_stock }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">コメント</th>
                        <td class="detail_td detail_row">{{ $item->comment }}</td>
                    </tr> 
                </table>
    
                    <button type="button" class="btn1 btn_primary" onclick="location.href='{{ route('edit', ['id' => $item->id]) }}' ">編集</button>
                    <button type="button" class="btn2 btn_primary" onclick="location.href='{{ route('list') }}'">戻る</button>
            </div>

        </div>
@endsection
