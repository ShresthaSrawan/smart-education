<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Notifications\NoticeSent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNotice;

class NoticeController extends Controller
{
    public function store(StoreNotice $request)
    {
        $notice = Notice::create($request->data());

        Notification::send($request->notifiables(), new NoticeSent($notice, $request->notify));

        return ['status' => 'ok'];
    }

    public function show(Notice $notice)
    {
        dd($notice);
    }
}
