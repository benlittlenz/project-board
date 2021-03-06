<?php

namespace App\Observers;

use App\Activity;
use App\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->recordActivity('created');
        // Activity::create([
        //     'project_id' => $task->project->id,
        //     'description' => 'created_task'
        // ]);
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        if(!$task->completed) return;

        Activity::create([
            'project_id' => $task->project->id,
            'description' => 'completed_task'
        ]);
    }

    // protected function recordActivity($type, $task) {
    //     Activity::create([
    //         'project_id' => $task->project->id,
    //         'description' => $type
    //     ]);
    // }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
