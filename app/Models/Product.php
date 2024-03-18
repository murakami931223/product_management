<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Models\Section;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'product_name', 
        'price', 
        'stock', 
        'comment', 
        'img_path',
    ];

        public function company()
        {
            return $this->belongsTo(Company::class, 'company_id', 'id');
        }

        public function sale() {
            return $this->hasMany(Sale::class, 'product_id', 'id');
        }

        
        // 登録処理
        public function registProduct($request) {
            
            $product = new Product();      
            $product->company_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            // ファイルアップロード処理
            $this->uploadFile($request, $product);
            
            $product->save();
        }
        
        //更新処理
        public function editProduct($request,$id) {
            
            $product = Product::find($id);
            $product->company_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            // ファイルアップロード処理
            $this->uploadFile($request, $product);
            
            // 変更をデータベースに保存
            $product->save();
        }
        
        private function uploadFile($request, $product) {
            $file = $request->file('img_path');
            if (!empty($file)) {
                if ($file->isValid()) {
                    // ファイルが有効であれば保存処理を行う
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/uploads', $filename);
                    // ファイルの保存先パスを取得します。デフォルトではstorage/app/uploadsに保存されます。
                    // 他の場所に保存する場合は、storeメソッドの第二引数にディレクトリを指定します。
                    $product->img_path = 'storage/uploads/' . $filename;
                }
            }
        }
}