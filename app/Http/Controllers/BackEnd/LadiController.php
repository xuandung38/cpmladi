<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LadiUpdateRequest;
use Illuminate\Http\Request;

class LadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$html = \File::get(public_path('template/default.tpl'));

        return view('backend.index', compact('html'));
    }

    public function update(LadiUpdateRequest $request)
    {
    	//backup code
	    $old = \File::get(public_path('template/default.tpl'));

	    \File::put(public_path('template/backup.tpl'), $old);

	    // push new code
		\File::put(public_path('template/default.tpl'), $request->input('code'));

	    return  redirect()->route('admin.ladi.index')->with('status', 'Sửa template thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset()
    {
	    $defautl = \File::get(public_path('template/backup.tpl'));
	    \File::put(public_path('template/default.tpl'), $defautl);

	    return  redirect()->route('admin.ladi.index')->with('status', 'Khôi phục template thành công!');
    }
}
