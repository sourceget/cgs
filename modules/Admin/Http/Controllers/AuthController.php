<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    
    protected $redirectAfterLogout = '/admin/login';
    
    protected $guard = 'admin';
    
    protected $username = 'email';
    
    protected $loginView ='admin::auth.login';
    
    
    public function __construct() {
        $this->username = 'mobile';
    }



    /**
     * 登陆成功事件
     * @param type $request
     * @param Authenticatable $user
     * @return type
     */
    public function authenticated($request, Authenticatable $user) {
        return redirect()->intended($this->redirectPath());
    }
}
