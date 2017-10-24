<?php

namespace App\Jobs;

use App\Matakuliah;
use App\Notifications\NewMessageNotif;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    
    protected $pendaftar;
    protected $message;
    protected $schedule;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pendaftar,$message,$schedule)
    {
        $this->pendaftar = $pendaftar;
        $this->message = $message;
        $this->schedule=$schedule;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    /*Pengiriman pesan terjadwal*/

    public function handle()
    {
        Notification::send($this->pendaftar,new NewMessageNotif($this->message));

        $this->schedule->status='delive';
        $this->schedule->save();
    }
}
