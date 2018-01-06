<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nowy(Request $request){
        $msg = new App\Chatmsg();
        $msg->user = auth()->user()->name;
        $msg->text = $request->text;
        $msg->setUpdatedAt(now());
        $msg->setCreatedAt(now());
        $msg->save();
        return $this->getlast();

    }

    public function getlast(){
        $this->deleteold();
        return ['success' => true, 'data' => App\Chatmsg::all()];
    }

    public function deleteold(){
        $date = new DateTime;
        $date->modify('-60 minutes');
        $formatted = $date->format('Y-m-d H:i:s');
        App\Chatmsg::where('updated_at', '<=', $formatted)->delete();

    }
}
