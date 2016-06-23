<?php

namespace Modules\Logistic\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Logistic\Repositories\LogisticRepository;
use Modules\Logistic\Http\Requests\LogisticRequest;
use Modules\Logistic\Traits\LogisticTrait;
use Modules\Logistic\Http\Services\LogisticService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Request;

class LogisticController extends Controller {
    
    use LogisticTrait;
    
    /**
     *
     * @var LogisticRepository
     */
    protected $respository;
    
    /**
     *
     * @var LogisticService
     */
    protected $service;
      
    
    function __construct() {
        $this->respository  = app(LogisticRepository::class);
        $this->service      = app(LogisticService::class);
    }
    
    public function index()
    {
        $items   = $this->respository->paginate();
        return view('logistic::index',['items'=>$items]);
    }
    
    public function create(){
        $id = Request::get('id');
        $obj    = $this->respository->model();
        $data   = ['title'=> '新增','obj'=>$obj,'type'=>'create'];
        return view('logistic::create', $data);
    }
    
    public function edit(){
        $id = Request::get('id');
        try {
            $obj    = $this->respository->query()->findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            Session::flash('error', '未找到');
            return redirect(route('logistic.edit'));
        }
        $data   = ['title'=> '编辑','obj'=>$obj,'type'=>'edit'];
        return view('logistic::edit', $data);
    }
    
    public function save(LogisticRequest $form){
        $data       = $form->request->all();
        $id         = $form->get('id',null);
        if(!$id){
            $ret   = $this->respository->create($data);
            Session::flash('success', '新增成功');
        }else{
            $ret    = $this->respository->update($data, $id);
            Session::flash('success', '更新成功');
        }
        return redirect(route('logistic.edit').'?id='.$ret->id);
    }
    
    public function delete(){
        $id = Request::get('id');
        $this->respository->delete($id);
        Session::flash('success', '删除成功');
        return redirect(route('logistic.index'));
    }
}

