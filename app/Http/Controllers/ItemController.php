<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\ProductregistRequest;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //商品一覧画面表示
    public function showList(Request $request) {
        $keyword = $request->input('keyword');
        $maker = $request->input('maker_name');
        /* インスタンス生成
        $model = new Item();
        $items = $model->getList();
        */

        $query = Item::query();

        /* キーワードから検索処理 */
        if(!empty($keyword)) {//$keyword が空ではない場合、検索処理を実行します
            $query->where('items_name', 'LIKE', "%{$keyword}%")
            ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        /* 選択肢から検索処理 */
        if(!empty($maker)) {//$maker が空ではない場合、検索処理を実行します
            $query->where('maker_name','LIKE', $maker);
        }

        $items = $query->paginate(10);

        return view('list', compact('items', 'keyword'));
    }

    //商品登録画面表示
    public function showItemregistForm() {
        return view('itemregist');
    }

    //商品登録処理
    public function itemregistSubmit(ItemregistRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Item();
            $model->registItem($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらitemregistにリダイレクト
        return redirect(route('itemregist'));
    }

    //削除処理
    public function delete(Item $item){
    $item->delete();
    return redirect(route('list'))->with('success', '削除しました');
    }

    //商品詳細画面表示
    public function showDetail($id) {
        $item = Item::find($id);

        // データが見つかったかどうかをチェック
        if (!$item) {
            // データが見つからない場合の処理を記述
            abort(404);
        }

        return view('detail', ['item' => $item]);
    }

    //商品編集画面表示
    public function showEdit($id) {
        $item = Item::find($id);

        // データが見つかったかどうかをチェック
        if (!$item) {
            // データが見つからない場合の処理を記述
            abort(404);
        }

        return view('edit', ['item' => $item]);
    }

    //更新処理
    public function update(ItemregistRequest $request, $id)
    {
        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 更新処理呼び出し
            $model = new Item();
            $model->editItem($request,$id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('edit', ['id' => $id]));
    }

}
