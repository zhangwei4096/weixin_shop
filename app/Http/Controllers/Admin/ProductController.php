<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
header("Content-type:text/html;Charset=Utf-8");
class ProductController extends Controller
{
    //产品控制器
    public function index(){
        //产品列表页面
        return view('Admin.product.index');
    }


    public function add(){
        //产品添加
        return view('Admin.product.add');
    }

    public function posts(Request $request){
        //产品添加
        $info    = $request->except('_token');  //获取除了_token以外的数据
        $product = new Product();
        $product->title = $info['title'];
        $product->chandi= $info['chandi'];
        $product->jjdw  = $info['jjdw'];
        $product->zl    = $info['zl'];
        $product->info  = $info['info'];
        $product->thumb = $info['thumb'];
        $product->content= $info['content'];
        $product->xs_price = $info['xs_price'];
        $product->sc_price = $info['sc_price'];
        $product->cb_price = $info['cb_price'];
        $product->start_time = $info['start_time'];
        $product->end_time   = $info['end_time'];
        if ($product->save()){
            return [
                'msg' => 'success',
                'data'=> '保存成功'
            ];
        }else{
            return [
                'msg' => 'error',
                'data'=> '错误'
            ];
        }


    }

    public function get(Request $request){
        //数据请求接口
        $result = $request->post();
        $limit  = $result['limit'];
        $page   = ($result['page']-1)*$limit;;
        $data   = DB::table('weixin_product')->select('id','title','thumb','type','xs_price','cb_price','chandi',
            'start_time','end_time','info')->offset($page)->limit($limit)->get();
        $info   = [
            'code' => 0,
            'msg'  => '',
            'count'=> count(Product::all()),
            'data' => $data
        ];

        return $info;
    }


    public function update(Request $request){
        //产品修改展示页面
        $id   = $request->post('id');
        $data = Product::findOrFail($id);  //获取数据
        return view('Admin.product.update',[
            'data' => $data
        ]);
    }

    public function type(Request $request){
        $type    = $request->post('type');

        $product = Product::find($request->post('id'));
        $product->type = ($type == '0') ? '1' : '0';
        if ($product->save()){
            return [
                'msg' => 'success',
                'data'=> ($type == '0') ? '已上架' : '已下架',
            ];
        }
    }

    public function edit(Request $request){
        //产品数据修改
        $data    = $request->except('_token');
        $product = Product::find($data['id']);
        $product->title = $data['title'];
        $product->chandi= $data['chandi'];
        $product->jjdw  = $data['jjdw'];
        $product->zl    = $data['zl'];
        $product->info  = $data['info'];
        $product->thumb = $data['thumb'];
        $product->content= $data['content'];
        $product->xs_price = $data['xs_price'];
        $product->sc_price = $data['sc_price'];
        $product->cb_price = $data['cb_price'];
        $product->start_time = $data['start_time'];
        $product->end_time   = $data['end_time'];
        if ($product->save()){
            return [
                'msg' => 'success',
                'data'=> '数据修改成功'
            ];
        }
    }

    public function delete(Request $request){
        //删除数据
        $id     = $request->post('id');
        if(Product::destroy($id)){
            return [
                'msg' => 'success',
                'data'=> '删除成功'
            ];
        }

    }

    public function upload(Request $request){
        //缩略图上传
        if ($request->hasFile('photo') && $request->file('photo')->isValid()){
            $path = $request->photo->storeAs('images',time().mt_rand(1000,9999).'.jpg','upload');
            if ($path){
                $fileUrl = '/upload/images/'.date("Ymd").'/'.$path;
                return [
                    'msg' => 'success',
                    'url' => $fileUrl
                ];
            }else{
                return [
                    'msg' => 'error'
                ];
            }

        }

    }
}
