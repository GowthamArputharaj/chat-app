<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allMessages(Request $request)
    {
        $data = [];
        $data['messages'] = null;

        $data['messages'] = Messages::where(['received_id' => 0])->latest()->paginate(20);
        
        // dump(rsort($data['messages']->values()));
        
        // echo $data['messages']->links();

// die;
        $response = $data['messages']->reverse()->values();
        // $response = $data['messages']->values();

        // dump($response, gettype($response), $response);
        // die;
        return $response;
        // dd($data);
        return response(json_encode($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // return $request->content ?? 'no message';

        $content = $request->content;
        $sent_id = auth()->user()->id;
        $sent_by = auth()->user()->name;

        // save message
        $message = new Messages();
        $message->content = $content;
        $message->sent_id = $sent_id;
        $message->sent_by = $sent_by;
        if(isset($request->received_id)) {
            $message->received_id = $request->received_id;
            $message->type = 'private';
        } else {
            $message->received_id = 0;
            $message->type = 'group';
        }
        $message->save();

        broadcast(new NewMessage($message))->toOthers();
        
        return response(json_encode(['message' => Messages::find($message->id)]));

    }

    public function allPrivateMessages(Request $request)
    {

        $received_id = $request->user_id;
        // dd($received_id, auth()->user()->id);

        $data['messages'] = Messages::
            where(function($q) use($received_id) {
                $q->where('sent_id', auth()->user()->id);
                $q->where('received_id', $received_id);
            })
            ->orWhere(function($q) use($received_id) {
                $q->where('received_id', auth()->user()->id);
                $q->where('sent_id', $received_id);               
            })
            ->latest()->paginate(20);

        $response = $data['messages']->reverse()->values();
        // $response = $data['messages']->values();

        // dump($response, gettype($response), $response);
        // die;
        return $response;  


    }


}
