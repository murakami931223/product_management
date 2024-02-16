<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{

    protected $fillable = [
        'items_name', 
        'maker_name', 
        'price', 
        'items_stock', 
        'comment', 
        'items_img'
    ];

    public function getList() {
        //itemsテーブルからデータを取得
        $items = DB::table('items')->get();

        return $items;
    }

    public function registItem($request) {

        $item = new Item();

        //ファイルアップロード処理
        $file = $request->file('items_img');
        if (!empty($file)) {
            if($file->isValid()){
                // ファイルが有効であれば保存処理を行う
                $filename=$request->file('items_img')->getClientOriginalName();
                $path = $request->file('items_img')->storeAs('public/uploads',$filename);
                // ファイルの保存先パスを取得します。デフォルトではstorage/app/uploadsに保存されます。
                // 他の場所に保存する場合は、storeメソッドの第二引数にディレクトリを指定します。
                $item->items_img = 'storage/uploads/' . $filename;
            }     
        }else{
            $item->items_img = '';
        } 

        // 登録処理
        DB::table('items')->insert([
            'items_name' => $request->items_name,
            'maker_name' => $request->maker_name,
            'price' => $request->price,
            'items_stock' => $request->items_stock,
            'comment' => $request->comment,
            'items_img' => $item->items_img,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function editItem($request,$id) {

        $item = Item::find($id);

       //ファイルアップロード処理
        $file = $request->file('items_img');
        if (!empty($file)) {
            if($file->isValid()){
                // ファイルが有効であれば保存処理を行う
                $filename=$request->file('items_img')->getClientOriginalName();
                $path = $request->file('items_img')->storeAs('public/uploads',$filename);
                // ファイルの保存先パスを取得します。デフォルトではstorage/app/uploadsに保存されます。
                // 他の場所に保存する場合は、storeメソッドの第二引数にディレクトリを指定します。
                $item->items_img = 'storage/uploads/' . $filename;
            }        
        }else{
            $item->items_img = '';
        } 

    //更新処理
    $item->update([
        'items_name' => $request->items_name,
        'maker_name' => $request->maker_name,
        'price' => $request->price,
        'items_stock' => $request->items_stock,
        'comment' => $request->comment,
        'items_img' => $item->items_img,
    ]);
    }


}
