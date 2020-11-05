<?php

namespace App\Http\Middleware;

use Closure;
use App\category;

class checkcategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  $count= category::all()->count();
        if($count==0){
            session()->flash('error','first you need add category');
            return redirect(route('categories.index'));}

        return $next($request);
    }
}
