@extends('layouts.app')

@section('content')
<div class="row">
            <div class="edit_title">商品編集画面</div>
            <form class="form_wrap" action="{{ route('edit.submit', ['id' => $item->id]) }}" enctype="multipart/form-data" method="post">
                @csrf

                <table class="form_group">
                    <tr>
                        <td class="id_title">ID.</td>
                        <td class="id_number">{{ $item->id }}</td>
                    </tr>
                </table>

                <div class="form_group">
                    <label for="items_name" class="required">商品名</label>
                    <input type="text" class="form_control" id="items_name" name="items_name" placeholder="" value="{{ old('items_name',$item->items_name) }}">
                    @if($errors->has('items_name'))
                        <p>{{ $errors->first('items_name') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="maker_name" class="required">メーカー名</label>
                    <select name="maker_name" id="maker_name">
                        <option value="{{ $item->maker_name }}">{{ $item->maker_name }}</option>
                        <option value="Coca-Cola" {{ old('Coca-Cola') === 'Coca-Cola' ? 'selected' : '' }}>Coca-Cola</option>
                        <option value="サントリー" {{ old('サントリー') === 'サントリー' ? 'selected' : '' }}>サントリー</option>
                        <option value="キリン" {{ old('キリン') === 'キリン' ? 'selected' : '' }}>キリン</option>
                    </select>
                    @if($errors->has('maker_name'))
                        <p>{{ $errors->first('maker_name') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="price" class="required">価格</label>
                    <input type="number" class="form_control" id="price" name="price" placeholder="" value="{{ old('price',$item->price) }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="items_stock" class="required">在庫数</label>
                    <input type="number" class="form_control" id="items_stock" name="items_stock" placeholder="" value="{{ old('items_stock',$item->items_stock) }}">
                    @if($errors->has('items_stock'))
                        <p>{{ $errors->first('items_stock') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="comment">コメント</label>
                    <textarea class="form_control" id="comment" name="comment" placeholder="Comment">{{ old('comment',$item->comment) }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="items_img">商品画像</label>
                    <input type="file" class="form_control" id="items_img" name="items_img" value="{{ old('items_img') }}">
                    @if($errors->has('items_img'))
                        <p>{{ $errors->first('items_img') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn1 btn_primary">更新</button>
                <button type="button" class="btn2 btn_primary" onclick="location.href='{{ route('detail', ['id' => $item->id]) }}'">戻る</button>

            </form>
        </div>
@endsection
