<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class MasterController extends Controller{
	public function list(Request $request): View{
        if (! Gate::allows('master_authorization')) {
            abort(403);
        }
        return view('master.list');
    }

    public function edit(Request $request){
    	Log::warning($request);
    	return Response()->json(['status'=>true,'msg'=>'successful ajax request']);
    }

    public function apiList(Request $request){
        Log::warning($request);
        return Response()->json(['status'=>true,'data'=>[]]);
    }
}