<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function store(Request $req)
    {
        $shortURL = Str::random(6);
        $link = new Link();
        $link->full_url = $req->url;
        $link->short_url = $shortURL;
        $link->user_id = Auth::user()->id;
        $link->save();

        return back()->with('shortUrl', url($shortURL));
    }

    public function redirect($url)
    {
        $link = Link::where('short_url', $url)->firstOrFail();
        return redirect()->away($link->full_url);
    }

    public function remove(Request $req) {
        $link = Link::find($req->id);
        if($link){
            $link->delete();
            $data = [
                'title' => 'ลบสำเร็จ!',
                'msg' => 'ลบโมเดลสำเร็จ!',
                'status' => 'success',
            ];
            return $data;
        }
        return back()->with('message', 'ไม่พบข้อมูล');
    }

    public function show(){
        return datatables()->of(Link::with('user:id,name'))->toJson();
    }
}
