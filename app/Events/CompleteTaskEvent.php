<?php

namespace App\Events;

use App\Http\Models\Task;

class CompleteTaskEvent extends Event
{
    /**
     * @var Task
     */
    public $task;

    /**
     * TaskEvent constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}