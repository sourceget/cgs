<?php

namespace Modules\WorkFlow\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\WorkFlow\Repositories\WorkFlowRepository;
use Modules\WorkFlow\Http\Requests\WorkFlowRequest;
use Modules\WorkFlow\Traits\WorkFlowTrait;
use Modules\WorkFlow\Http\Services\WorkFlowService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Request;

class WorkFlowController extends Controller {
    
    use WorkFlowTrait;
    
    /**
     *
     * @var WorkFlowRepository
     */
    protected $respository;
    
    /**
     *
     * @var WorkFlowService
     */
    protected $service;
      
    
    function __construct() {
        $this->respository  = app(WorkFlowRepository::class);
        $this->service      = app(WorkFlowService::class);
    }
    
    public function index()
    {
        return view('welcome');
        
        $items   = $this->respository->paginate();
        return view('work_flow::index',['items'=>$items]);
    }
    
    public function create(){
        $id = Request::get('id');
        $obj    = $this->respository->model();
        $data   = ['title'=> '新增','obj'=>$obj,'type'=>'create'];
        return view('work_flow::create', $data);
    }
    
    public function edit(){
        $id = Request::get('id');
        try {
            $obj    = $this->respository->query()->findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            Session::flash('error', '未找到');
            return redirect(route('work_flow.edit'));
        }
        $data   = ['title'=> '编辑','obj'=>$obj,'type'=>'edit'];
        return view('work_flow::edit', $data);
    }
    
    public function save(WorkFlowRequest $form){
        $data       = $form->request->all();
        $id         = $form->get('id',null);
        if(!$id){
            $ret   = $this->respository->create($data);
            Session::flash('success', '新增成功');
        }else{
            $ret    = $this->respository->update($data, $id);
            Session::flash('success', '更新成功');
        }
        return redirect(route('work_flow.edit').'?id='.$ret->id);
    }
    
    public function delete(){
        $id = Request::get('id');
        $this->respository->delete($id);
        Session::flash('success', '删除成功');
        return redirect(route('work_flow.index'));
    }
}

