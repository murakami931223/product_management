@extends('layouts.app')

@section('content')
<div class="row">
            <div class="detail_title">商品詳細画面</div>
            <div class="detail_wrap">
                <table>
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">ID.</th>
                        <td class="detail_td detail_row">{{ $product->id }}</td>
                    </tr>

                    <tr class="detail_tr">
                        <th class="detail_th detail_row">商品画像</th>
                        <td class="detail_td detail_row"><img src="{{ asset($product->img_path) }}" height="100px" alt="商品画像"></td>
                        
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">商品名</th>
                        <td class="detail_td detail_row">{{ $product->product_name }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">メーカー名</th>
                        <td class="detail_td detail_row">{{ $product->company->company_name }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">価格</th>
                        <td class="detail_td detail_row">{{ $product->price }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">在庫数</th>
                        <td class="detail_td detail_row">{{ $product->stock }}</td>
                    </tr>
    
                    <tr class="detail_tr">
                        <th class="detail_th detail_row">コメント</th>
                        <td class="detail_td detail_row">{{ $product->comment }}</td>
                    </tr> 
                </table>
    
                    <button type="button" class="btn1 btn_primary" onclick="location.href='{{ route('edit', ['id' => $product->id]) }}' ">編集</button>
                    <button type="button" class="btn2 btn_primary" onclick="location.href='{{ route('list') }}?{{ http_build_query($search) }}'">戻る</button>
            </div>

        </div>
@endsection
