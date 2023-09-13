<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demo;


class DemoController extends Controller
{

    public function index(){
        $datas = Demo::all();
        return view('index', ['datas'=> $datas]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required',
            'name' => 'required',
            'key' => 'required'
        ]);

        $shortCode = $this->generateShortCode($data['key']);

        $data['short_url'] = $shortCode;

        Demo::create($data);

        return redirect()->route('root')->with('success', '新增成功!');
    }
    public function destroy($id){
        Demo::destroy($id);
        return redirect()->route('root')->with('success', '刪除成功!');
    }
    public function edit($id){
        $datas = Demo::all();
        $record = Demo::find($id);
        return view('edit', ['record'=> $record,'datas' => $datas]);
    }
    public function update(Request $request,$id){
        $data = $request->validate([
            'url' => 'required',
            'name' => 'required',
            'key' => 'required'
        ]);

        $shortCode = $this->generateShortCode($data['key']);
        $data['short_url'] = $shortCode;

        Demo::find($id)->update($data);
        return redirect()->route('root')->with('success', '修改成功!');
    }
    public function search(Request $request){
        $keyword = $request->input("key_search");
        $datas = Demo::where('key',$keyword)->get();
        return view('index', ['datas'=> $datas]);
    }
    private function generateShortCode($key)
    {

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        do {
            $randomCode = substr(str_shuffle($characters), 0, 6);

            $shortCode = $key . '_' . $randomCode;

            $existingDemo = Demo::where('short_url', $shortCode)->first();
        } while ($existingDemo);

        return $shortCode;
    }
    public function redirectToURL(Request $request, $shortCode){

        $shortUrlRecord = Demo::where('short_url', $shortCode)->first();
        if ($shortUrlRecord) {
            // 執行重定向到長 URL
            return redirect($shortUrlRecord['url']);
        } else {
            // 如果找不到相應的長 URL，可以執行一些錯誤處理邏輯，例如返回一個錯誤頁面或消息
            return view('errors.short_url_not_found');
        }
    }



}
