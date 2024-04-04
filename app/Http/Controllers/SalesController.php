<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
 // 商品購入処理
    public function purchase(Request $request)
    {
        
        try {
        // トランザクションを開始
        DB::beginTransaction();
         // リクエストから必要なデータを取得する
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

         // データベースから対象の商品を検索・取得
        $product = Product::find($productId); 

        // 商品が存在しない、または在庫が不足している場合のバリデーションを行う
        if (!$product) {
            return response()->json(['message' => '商品が存在しません'], 404);
        }
        if ($product->stock < $quantity) {
            return response()->json(['message' => '商品が在庫不足です'], 400);
        }

         // 在庫を減少させる
        $product->stock -= $quantity;
        $product->save();

         // Salesテーブルに商品IDと購入日時を記録する
        $sale = new Sale();
        $sale->product_id = $productId;
        $sale->save();

         // トランザクションをコミット
        DB::commit();

         // レスポンスを返す
        return response()->json(['message' => '購入成功']);

        } catch (\Exception $e) {

        DB::rollback();
    }
    }

}
