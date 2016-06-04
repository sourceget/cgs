<?php

namespace Modules\Department\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Department\Repositories\DepartmentRepository;
use Modules\Department\Http\Requests\DepartmentRequest;
use Modules\Department\Traits\DepartmentTrait;
use Modules\Department\Http\Services\DepartmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Request;

class DepartmentController extends Controller {
    
    use DepartmentTrait;
    
    /**
     *
     * @var DepartmentRepository
     */
    protected $respository;
    
    /**
     *
     * @var DepartmentService
     */
    protected $service;
      
    
    function __construct() {
        $this->respository  = app(DepartmentRepository::class);
        $this->service      = app(DepartmentService::class);
    }
    
    public function index()
    {
        //$this->service->sync();
        $table  = $this->respository->find(3);
        dd($table->syncUser());
        
        $items   = $this->respository->paginate();
        return view('department::index',['items'=>$items]);
    }
    
    public function create(){
        $id = Request::get('id');
        $obj    = $this->respository->model();
        $data   = ['title'=> '新增','obj'=>$obj,'type'=>'create'];
        return view('department::create', $data);
    }
    
    public function edit(){
        $id = Request::get('id');
        try {
            $obj    = $this->respository->query()->findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            Session::flash('error', '未找到');
            return redirect(route('department.edit'));
        }
        $data   = ['title'=> '编辑','obj'=>$obj,'type'=>'edit'];
        return view('department::edit', $data);
    }
    
    public function save(DepartmentRequest $form){
        $data       = $form->request->all();
        $id         = $form->get('id',null);
        if(!$id){
            $ret   = $this->respository->create($data);
            Session::flash('success', '新增成功');
        }else{
            $ret    = $this->respository->update($data, $id);
            Session::flash('success', '更新成功');
        }
        return redirect(route('department.edit').'?id='.$ret->id);
    }
    
    public function delete(){
        $id = Request::get('id');
        $this->respository->delete($id);
        Session::flash('success', '删除成功');
        return redirect(route('department.index'));
    }
}

