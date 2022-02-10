<?php

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function fetchMessages(User $user)
    {
        return Message::with('user')
                    ->where(['user_id'=> auth()->id(), 'receiver_id'=> $user->id])
                    ->orWhere(function($query) use($user){
                        $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
                    })
                    ->get();
    }

    public function sendMessage(Request $request, User $user)
    {
        /*
        $input = $request->all();
        $inputs['receiver_id'] = $user->id;
        $message = auth()->user()->messages()->create(['message'=>$inputs]);
        broadcast(new MessageSent($message->load('user')));
        return response(['status'=> 'Message sent successfully']);
        */
        if($file = $request->file('file')){
            $newfile=strtotime(date("Y-m-d H:i:s")).".".$file->getClientOriginalExtension();

            $file->move('chat/',$newfile);

            $message= Message::create([
                'user_id' => request()->user()->id,
                'file' => $newfile,
                'receiver_id' => $user->id
            ]);
        }else{
            $input=$request->all();
            $input['receiver_id']=$user->id;
            $message=auth()->user()->messages()->create($input);
        }

        broadcast(new MessageSent($message->load('user')))->toOthers();
        
        return response(['status'=>'Message private sent successfully','message'=>$message]);
        
    }
}
