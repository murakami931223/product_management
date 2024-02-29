@extends('layouts.app')

@section('content')
<div class="row">
            <div class="edit_title">商品編集画面</div>
            <form class="form_wrap" action="{{ route('edit.submit', ['id' => $product->id]) }}" enctype="multipart/form-data" method="post">
                @csrf

                <table class="form_group">
                    <tr>
                        <td class="id_title">ID.</td>
                        <td class="id_number">{{ $product->id }}</td>
                    </tr>
                </table>

                <div class="form_group">
                    <label for="product_name" class="required">商品名</label>
                    <input type="text" class="form_control" id="product_name" name="product_name" placeholder="" value="{{ old('product_name',$product->product_name) }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="company_id" class="required">メーカー名</label>
                    <select name="company_id" id="company_id">
                        <option value="{{ $product->company_id }}">{{ $product->company->company_name }}</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="price" class="required">価格</label>
                    <input type="number" class="form_control" id="price" name="price" placeholder="" value="{{ old('price',$product->price) }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="stock" class="required">在庫数</label>
                    <input type="number" class="form_control" id="stock" name="stock" placeholder="" value="{{ old('stock',$product->stock) }}">
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="comment">コメント</label>
                    <textarea class="form_control" id="comment" name="comment" placeholder="Comment">{{ old('comment',$product->comment) }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div class="form_group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form_control" id="img_path" name="img_path" value="{{ old('img_path',$product->img_path) }}">
                    @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn1 btn_primary">更新</button>
                <button type="button" class="btn2 btn_primary" onclick="location.href='{{ route('detail', ['id' => $product->id]) }}'">戻る</button>

            </form>
        </div>
@endsection
