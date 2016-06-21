<?php

namespace Modules\Baidu\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Baidu\Repositories\BaiduRepository;
use Modules\Baidu\Http\Requests\BaiduRequest;
use Modules\Baidu\Traits\BaiduTrait;
use Modules\Baidu\Http\Services\BaiduService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Request;
use Modules\Baidu\Utils\Province;

class BaiduController extends Controller {
    
    use BaiduTrait;
    
    /**
     *
     * @var BaiduRepository
     */
    protected $respository;
    
    /**
     *
     * @var BaiduService
     */
    protected $service;
      
    
    function __construct() {
        $this->respository  = app(BaiduRepository::class);
        $this->service      = app(BaiduService::class);
    }
    
    public function oauth(){
        //http://cgs.xincap.com/oauth/baidu/
        $clientId   = env('BAIDU_KEY');
        $clientSecret   = env('BAIDU_SECRET');
        $redirectUri   = env('BAIDU_REDIRECT');
        $oauth  = new BaiduOAuth($clientId, $clientSecret);
        $oauth->setRedirectUri($redirectUri);
        if(!Request::has('code') || !Request::get('code')){
            $url    = $oauth->getAuthorizeUrl();
            return redirect($url);
        }
        $code   = Request::get('code');
        $token  = $oauth->getAccessTokenByAuthorizationCode($code);
        if(is_array($token)){
            Session::pull('sdk_baidu', $token);
            return response($token['access_token']);
        }
        return response('failed.');
    }
    
    public function index()
    {
        $province   = new Province();
        $province->proccess();
        $items   = $this->respository->paginate();
        return view('baidu::index',['items'=>$items]);
    }
    
    public function create(){
        $id = Request::get('id');
        $obj    = $this->respository->model();
        $data   = ['title'=> '新增','obj'=>$obj,'type'=>'create'];
        return view('baidu::create', $data);
    }
    
    public function edit(){
        $id = Request::get('id');
        try {
            $obj    = $this->respository->query()->findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            Session::flash('error', '未找到');
            return redirect(route('baidu.edit'));
        }
        $data   = ['title'=> '编辑','obj'=>$obj,'type'=>'edit'];
        return view('baidu::edit', $data);
    }
    
    public function save(BaiduRequest $form){
        $data       = $form->request->all();
        $id         = $form->get('id',null);
        if(!$id){
            $ret   = $this->respository->create($data);
            Session::flash('success', '新增成功');
        }else{
            $ret    = $this->respository->update($data, $id);
            Session::flash('success', '更新成功');
        }
        return redirect(route('baidu.edit').'?id='.$ret->id);
    }
    
    public function delete(){
        $id = Request::get('id');
        $this->respository->delete($id);
        Session::flash('success', '删除成功');
        return redirect(route('baidu.index'));
    }
}

