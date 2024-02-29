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

        //画面一覧表示
        public function getList($keyword = null, $company = null) {
            $query = Product::query();

         // キーワードからの検索
        if (!is_null($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('product_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('price', 'LIKE', "%{$keyword}%");
            });

        // 選択肢からの検索
        if (!is_null($company)) {
            $query->where('company_id', $company);
            }

        return $query->paginate(10);

        }
    }

        public function registProduct($request) {

            $product = new Product();      
            // 登録処理
            $product->company_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            //ファイルアップロード処理
            $file = $request->file('img_path');
            if (!empty($file)) {
                if($file->isValid()){
                    // ファイルが有効であれば保存処理を行う
                    $filename=$request->file('img_path')->getClientOriginalName();
                    $path = $request->file('img_path')->storeAs('public/uploads',$filename);
                    // ファイルの保存先パスを取得します。デフォルトではstorage/app/uploadsに保存されます。
                    // 他の場所に保存する場合は、storeメソッドの第二引数にディレクトリを指定します。
                    $product->img_path = 'storage/uploads/' . $filename;
                }     
            }else{
                $product->img_path = '';
            }
            
            $product->save();
        }
    
        public function editProduct($request,$id) {
    
            $product = Product::find($id);
            //更新処理
            $product->company_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            //ファイルアップロード処理
            $file = $request->file('img_path');
            if (!empty($file)) {
                if($file->isValid()){
                 // ファイルが有効であれば保存処理を行う
                    $filename=$file->getClientOriginalName();
                    $path = $file->storeAs('public/uploads',$filename);
                 // ファイルの保存先パスを取得します。デフォルトではstorage/app/uploadsに保存されます。
                 // 他の場所に保存する場合は、storeメソッドの第二引数にディレクトリを指定します。
                    $product->img_path = 'storage/uploads/' . $filename;
                }        
            }

            // 変更をデータベースに保存
            $product->save();
        }
        
}
