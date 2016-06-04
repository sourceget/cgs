<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Admin\Repositories\TestRepository;
use Modules\Admin\Http\Requests\TestRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Request;


class Test extends Controller {
    
    /**
     *
     * @var TestRepository
     */
    protected $respository;
      
    
    function __construct() {
        $this->respository = app(TestRepository::class);
    }
    
    public function index()
    {
        $items   = $this->respository->paginate();
        return view('admin::index',['items'=>$items]);
    }
    
    public function create(){
        $id = Request::get('id');
        $obj    = $this->respository->model();
        $data   = ['title'=> '新增','obj'=>$obj,'type'=>'create'];
        return view('admin::create', $data);
    }
    
    public function edit(){
        $id = Request::get('id');
        try {
            $obj    = $this->respository->query()->findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            Session::flash('error', '未找到');
            return redirect(route('admin.edit'));
        }
        $data   = ['title'=> '编辑','obj'=>$obj,'type'=>'edit'];
        return view('admin::edit', $data);
    }
    
    public function save(TestRequest $form){
        $data       = $form->request->all();
        $id         = $form->get('id',null);
        if(!$id){
            $ret   = $this->respository->create($data);
            Session::flash('success', '新增成功');
        }else{
            $ret    = $this->respository->update($data, $id);
            Session::flash('success', '更新成功');
        }
        return redirect(route('admin.edit').'?id='.$ret->id);
    }
    
    public function delete(){
        $id = Request::get('id');
        $this->respository->delete($id);
        Session::flash('success', '删除成功');
        return redirect(route('admin.index'));
    }
}

