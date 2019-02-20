<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Dialog;
use App\Message;
use App\MessageFile;
use App\User;

class DialogsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }


    public function test($name){
        return response()->print("Hello ".$name);
    }
    
    public function index(Request $request) {

        $user_id = $request->get('user_id');
        if ($user_id) {
            $dialogs = Dialog::whereHas('users', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->get();
        } else {
            $dialogs = Dialog::all();
        }

        foreach($dialogs as $dialog) {
            $dialog->load('messages', 'users');

            foreach($dialog->messages as $message) {
                $message->load('author', 'files');
            }
        }

        return response()->json($dialogs);
    }

    public function get($dialog_id) {
        $dialog = Dialog::find($dialog_id);
        $dialog->load('messages', 'users');

        foreach($dialog->messages as $message) {
            $message->load('author', 'files');
        }

        return response()->json($dialog);
    }

    public function create($dialog_id = null) {
        $user = auth()->user();
        $dialog = null;
        $request = request();

        if ($dialog_id) {
            $dialog = Dialog::find($dialog_id);
        }

        if (!$dialog) {
            $dialog_data = $request->only('title');
            $dialog = Dialog::create($dialog_data);
            $recipient = User::find($request->get('user_id'));
            $dialog->users()->attach([$user->id, $recipient->id]);
            $dialog->save();
        }

        $messageData = array('text' => $request->get('message'));

        $messageData = array_merge($messageData, array(
            'dialog_id' => $dialog->id,
            'user_id' => $user->id
        ));

        $message = Message::create($messageData);

        // Upload files
        $uploadedFiles = $request->file('file');

        if ($uploadedFiles && count($uploadedFiles)) {
            $dirname = time();

            foreach($uploadedFiles as $file) {
                Storage::disk('public')->putFileAs(
                    'files/'.$dirname,
                    $file,
                    $file->getClientOriginalName()
                );

                $url = Storage::disk('public')->url('files/'.$dirname.'/'.$file->getClientOriginalName());

                $fileData = [
                    'filename' => $file->getClientOriginalName(),
                    'message_id' => $message->id,
                    'download_url' => $url,
                    'size' => $file->getClientSize(),
                    'type' => $file->guessExtension(),
                    'mimetype' => $file->getMimeType()
                ];

                MessageFile::create($fileData);
            }
        }

        $dialog->load('messages', 'users');

        foreach($dialog->messages as $message) {
            $message->load('author', 'files');
        }

        return response()->json($dialog);
    }
}
