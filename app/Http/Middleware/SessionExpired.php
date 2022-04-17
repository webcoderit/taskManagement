<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Session\Store;
use Auth;
use Illuminate\Support\Carbon;
use Session;

class SessionExpired {
    protected $session;
    protected $timeout = 60;

    public function __construct(Store $session){
        $this->session = $session;
    }
    public function handle($request, Closure $next){
        $isLoggedIn = $request->path() != 'logout';
        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'login');
            if (auth()->check()){
                $user = User::where('id', auth()->user()->id)->first();
                $user->status = 0;
                $user->out_time = Carbon::now();
                $user->save();

                echo "<script>
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                </script>";
            }
            auth()->logout();
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
}
