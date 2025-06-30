<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteCompletedTask implements ShouldQueue
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function handle()
    {
        $fresh = Task::find($this->task->id);

        if ($fresh && $fresh->finalizado) {
            $fresh->forceDelete();
            \Cache::tags('tasks')->flush();
        }
    }
}