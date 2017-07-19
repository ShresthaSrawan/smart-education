<?php

namespace App\Http\Controllers;

use Notification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNotice;

class NoticeController extends Controller
{
    public function store(StoreNotice $request)
    {
    	$notice = Notice::create($request->data());

    	Notification::send($request->notifiables(), new NoticeSent($notice));

    	return redirect()->route('home')->withSuccess(trans('messages.create_success', [ 'entity' => 'Notice' ]));
    }
}
