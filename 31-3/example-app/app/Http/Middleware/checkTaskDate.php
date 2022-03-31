<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkTaskDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $endDate = strtotime($request->endDate);
        if( $endDate > now() ){
            return $next($request);
        }
        else{
            session()->flash('mssg', 'This task is expired, you can not delete it');
            return redirect(url('/index'));
        }
    }
}
