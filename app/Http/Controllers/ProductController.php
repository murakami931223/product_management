<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductregistRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //商品一覧画面表示
    public function showList(Request $request) {
        $keyword = $request->input('keyword');
        $company = $request->input('company_id');
        $lower_price = $request->input('lower_price');
        $upper_price = $request->input('upper_price');
        $lower_stock = $request->input('lower_stock');
        $upper_stock = $request->input('upper_stock');

        // companiesテーブルからデータを取得
        $companies = Company::all();
    
        // 商品リストを取得
        $query = Product::query();

        // キーワードからの検索
        if (!is_null($keyword)) {
        $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        // 選択肢からの検索
        if (!is_null($company)) {
        $query->where('company_id', $company);
        }

        //下限価格からの検索
        if (!is_null($lower_price)) {
            $query->where('price','>=', $lower_price);
            }

        // 上限価格からの検索
        if (!is_null($upper_price)) {
            $query->where('price', '<=', $upper_price);
            }

        //下限在庫からの検索
        if (!is_null($lower_stock)) {
            $query->where('stock','>=', $lower_stock);
            }

        // 上限在庫からの検索
        if (!is_null($upper_stock)) {
            $query->where('stock', '<=', $upper_stock);
            }

        $products = $query->paginate(10);

        // セッションに検索条件を保存
        $request->session()->put('search', [
            'keyword' => $keyword,
            'company_id' => $company,
            'lower_price' => $lower_price, 
            'upper_price' => $upper_price,
            'lower_stock' => $lower_stock, 
            'upper_stock' => $upper_stock,
            'page' => $products->currentPage(),
        ]);

        // セッションに保存された検索条件を取得し、ビューに渡す
        $search = $request->session()->get('search');

        // ビューを返す
        return view('list', compact('products', 'companies', 'search'));
    }

    //商品登録画面表示
    public function showProductregistForm() {
        // companiesテーブルからデータを取得
        $companies = Company::all();
        // 一覧画面のセッション情報を取得
        $search = session('search');

        return view('productregist',compact('companies', 'search'));
    }

    //商品登録処理
    public function productregistSubmit(productregistRequest $request) {
        
        try {
            // トランザクション開始
            DB::beginTransaction();
            // 登録処理呼び出し
            $product = new Product();
            $product->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらproductregistにリダイレクト
        return redirect(route('productregist'));
    }

    //削除処理
    public function delete(Request $request,$deleteID){
        $product = Product::findOrFail($deleteID);
        
        try {
            // トランザクション開始
            DB::beginTransaction();
            // 削除処理呼び出し
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        
        return response()->json(['message' => '削除が完了しました']);
    }

    //商品詳細画面表示
    public function showDetail($id) {
        $product = Product::find($id);
        // 一覧画面のセッション情報を取得
        $search = session('search');

        // データが見つかったかどうかをチェック
        if (!$product) {
            // データが見つからない場合の処理を記述
            abort(404);
        }


        return view('detail', compact('product', 'search'));
    }

    //商品編集画面表示
    public function showEdit($id) {
        $product = Product::findOrFail($id);
        $companies = Company::all();

        // データが見つかったかどうかをチェック
        if (!$product) {
            // データが見つからない場合の処理を記述
            abort(404);
        }

        return view('edit', compact('product', 'companies'));
    }

    //更新処理
    public function update(ProductregistRequest $request, $id)
    {
        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 更新処理呼び出し
            $product = new Product();
            $product->editProduct($request,$id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        
        return redirect(route('edit', ['id' => $id]));
    }
}