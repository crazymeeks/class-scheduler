<?php

namespace Scheduler\App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Scheduler\App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    use ThrottlesLogins;

    const LOCKTIME = 60;

    const ALLOWED_ATTEMPTS = 3;

    /**
     * Lock time after reaching max login attempts
     * @var int
     */
    protected $lockoutTime;

    /**
     * The max login attempts allowed
     * 
     * @var int
     */
    protected $maxLoginAttempts;

    public function __construct()
    {
        $this->lockoutTime = self::LOCKTIME;

        $this->maxLoginAttempts = self::ALLOWED_ATTEMPTS;
    }

    /**
     * Display the login view page
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function loginView(Request $request)
    {
        $data = $this->getFormData();

        if (Auth::guard('admin')->viaRemember()) {
            return redirect('/admin');
        }

        if (Auth::guard('admin')->user()) {
            return redirect('/admin');   
        }
        return admin_view('pages.login.form', $data());
    }

    /**
     * Get login form data
     * 
     * @return \Closure
     */
    private function getFormData()
    {
        return function(){
            return [
                'url' => url('post-login'),
            ];
        };
    }

    /**
     * Authenticate user for login
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postAuthenticate(Request $request)
    {
        

        $this->validateLogin($request);

        // throttle
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $this->remember($request))) {

            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            return redirect('/admin');
        }
        $this->incrementLoginAttempts($request);

        return redirect()->back()->with('error', 'Invalid account.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return response('Logout', 200);
    }

    /**
     * Determine if user would want to remember his/her account after successful login
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return bool
     */
    private function remember(Request $request)
    {
        return $request->has('remember') && $request->remember == 'on';
    }


    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTime
        );
    }


    /**
     * The username to validate, in this case our username is the user's email
     *
     * Used by Throttle
     * 
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Validate Login
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    private function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required',
        ]);
    }
}
