<?php

namespace App\Http\Controllers;

use App\Jobs\SendReplayJob;
use App\Jobs\SendSingleReplayJob;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {

        $table = 'dachboard';
        $messages = Message::groupBy('created_at', 'desc')->get();
        return view('messages.index', compact('table', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function markAsRead($id)
    {
        $message = Message::find($id);
        $message->read_at = now();
        $message->save();

        return redirect()->back();
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'messages' => 'required',
        ]);

        // Create message
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->messages,
        ]);
        // Mail::to($messages->email)->send(new userMail($messages)); // Pass $users instead of $user

        return redirect()->back()->with('success', 'Message sent successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $table = 'dachboard';
        $message = Message::findOrFail($id);

        $message->read_at = now();
        $message->save();
        return view('messages.show', compact('message', 'table'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Message removed successfully');
    }

    public function sendReplay(Request $request)
    {
        $validatedData = $request->validate([
            'replaySubject' => 'required|string',
            'replayMessage' => 'required|string'
        ]);

        //only for no repeated emails
        $messages = Message::select('name', 'email')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('messages')
                    ->groupBy('email');
            })
            ->get();


        if ($messages->isEmpty()) {
            return response()->json([
                'message' => 'There are no messages to send replays to'
            ], 404);
        }

        foreach ($messages as $message) {
            SendReplayJob::dispatch($message->name, $message->email, $validatedData['replaySubject'], $validatedData['replayMessage']);
        }

        return response()->json([
            'message' => 'Emails are being sent'
        ], 201);
    }

    public function sendReplayToSpecificContact(Request $request)
    {
        $validatedData = $request->validate([
            'replayMessage' => 'required|string',
            'replaySubject' => 'required|string',
            'messageId' => 'required'
        ]);

        $message = Message::find($validatedData['messageId']);

        if (!$message) {
            return response()->json([
                'message' => 'There are no message to send replay to'
            ], 404);
        }

        SendSingleReplayJob::dispatch($message->name, $message->email, $validatedData['replaySubject'], $validatedData['replayMessage']);

        return response()->json([
            'message' => 'Email is being sent'
        ], 201);
    }
}
