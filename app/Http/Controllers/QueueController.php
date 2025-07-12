<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\QueueLog;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::orderBy('number')->paginate(10); // hanya sekali ini
        $current = Queue::where('status', 'called')->orderBy('called_at', 'desc')->first();

        return view('admin.dashboard', compact('queues', 'current'));
    }


    public function next(Request $request)
    {
        $current = Queue::where('status', 'called')->orderBy('called_at', 'desc')->first();

        if ($current) {
            $current->update(['status' => 'done']);
            $next = Queue::where('number', '>', $current->number)
                ->where('status', 'waiting')
                ->orderBy('number')
                ->first();
        } else {
            $next = Queue::where('status', 'waiting')->orderBy('number')->first();
        }

        if ($next) {
            $next->update([
                'status' => 'called',
                'called_at' => now(),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Panggil antrian berikutnya.');
    }

    public function prev(Request $request)
    {
        $current = Queue::where('status', 'called')->orderBy('called_at', 'desc')->first();

        if ($current) {
            $prev = Queue::where('number', '<', $current->number)
                ->where('status', 'done')
                ->orderBy('number', 'desc')
                ->first();

            if ($prev) {
                
                $current->update(['status' => 'waiting', 'called_at' => null]);

                $prev->update(['status' => 'called', 'called_at' => now()]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Kembali ke antrian sebelumnya.');
    }
}
