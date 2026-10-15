<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class SchoolAuth { public function handle(Request $request, Closure $next) { if (!$request->session()->has('school_user')) return redirect('/login'); return $next($request); } }
