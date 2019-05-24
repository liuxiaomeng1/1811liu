<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Redis;

use Illuminate\Validation\Rule;
use App\Wen;
use App\Wz;
use DB;

class WenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $quest=$request->all();
        //dd($quest['w_name']);
        $where=[];
        if ($quest['title']??'') {
            $where[]=['title','like',"%$quest[title]%"];
        }
        if ($quest['w_name']??'') {
            $where[]=['w_name','=',"$quest[w_name]"];
        }
        $dat=Wen::where($where)->join('wz','wen.w_id','=','wz.w_id')->orderby('id','desc')->paginate(2);
        //dd($data);
        $data=DB::table('wz')->get()->toArray();
        $data=$this->createTree($data);
        return view('/wen/list',['data'=>$data,'dat'=>$dat,'quest'=>$quest]);
       // dd($data);
        //echo"1";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTree($data,$w_pid=0,$level=1)
   {
   // $data=DB::table('wz')->get();
    if (!$data || !is_array($data)) {
        return;
    }
    static $arr=[];
    foreach($data as $k=>$v){
        if ($v->w_pid == $w_pid) {
            $v->level=$level;
            $arr[]=$v;
            $this->createTree($data,$v->w_id,$level+1);
        }
    }
    //dd($data);
    return $arr;

   }
    public function create()
    {
        //cache(['name'=>'刘小梦'],1);
       // dd(cache('name'));
        Redis::set('name','zz');
        dd(Redis::exists('aa'));
        $data=DB::table('wz')->get()->toArray();
       //dd($data);
        
        $data=$this->createTree($data);
        //dd($data);1
        return view('/wen/add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except('_token');
        $title=request()->input('title');
        if ($request->isMethod('ajax')) {
            $count = DB::table('wen')->where(['title'=>$title])->count();
            echo $count;
        }else{
             $validator = \Validator::make($request->all(), [
             'title' => 'max:255',
             
             ],[
                //'title.required'=>'必填',
             ]);
             if ($validator->fails()) {
             return redirect('wen/add')
             ->withErrors($validator)
            ->withInput();
             }

            //文件上传
            if ($request->hasFile('file')) {
                $res=$this->upload($request,'file');
               //dd($res);
                if ($res['code']) {
                    $data['file'] = $res['imgurl'];
                }
            }
            $data['create_time']=date('Y-m-d h:i:s',time());
          
            $res=DB::table('wen')->insert($data);
            //dd($res);
            //echo "11";
            if ($res) {
                return redirect('/wen/list');
            }
        } 
    }

    public function upload(Request $request,$file)
    {
        if ($request->file($file)->isValid()){
            $photo = $request->file($file);
            $store_result = $photo->store(date('ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $dat=DB::table('wen')->join('wz','wen.w_id','=','wz.w_id')->where(['id'=>$id])->first();
        //dd($data);,,
        
        $data=DB::table('wz')->get()->toArray();

       $data=$this->createTree($data);
       //dd($a);
       //dd($dat);
        return view('/wen/edit',['dat'=>$dat,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->input('id');
        //dd($id);
        $data=request()->except('_token');
             $validator = \Validator::make($request->all(), [
             'title' => 'max:255',
             Rule::unique('wen')->ignore($id),
             ],[
                //'title.required'=>'必填',
             ]);

             if ($validator->fails()) {
             return redirect('wen/add')
             ->withErrors($validator)
            ->withInput();
             }

            //文件上传
            if ($request->hasFile('file')) {
                $res=$this->upload($request,'file');
               //dd($res);
                if ($res['code']) {
                    $data['file'] = $res['imgurl'];
                }
            }
            $data['create_time']=date('Y-m-d h:i:s',time());
          
            $res=DB::table('wen')->where(['id'=>$id])->update($data);
            //dd($res);
            //echo "11";
            if ($res) {
                return redirect('/wen/list');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // dd($id);
        $res=DB::table('wen')->delete($id);
        //dd($res);
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功'];
            //echo 11;
        }else{
            return ['code'=>2,'msg'=>'删除失败'];
        }
    }
     //检查唯一性
    public function checkName(){
        $title=request()->title;
        if($title){
            $where['title']=$title;
            $count=Wen::where($where)->count();
            return ['code'=>1,'count'=>$count];
        }
    }
    public function info()
    {
        $id=request()->id;
        //dd($id);
        $dat=DB::table('wen')->join('wz','wen.w_id','=','wz.w_id')->where(['id'=>$id])->first();
        //dd($data);
        $data=DB::table('wz')->get()->toArray();

       $data=$this->createTree($data);
       //dd($a);
       //dd($dat);
        return view('/wen/info',['dat'=>$dat,'data'=>$data]);
    }
    public function ces()
    {
        cache(['name'=>'刘小梦']);
        dd(cache('name'));
    }
   
}
