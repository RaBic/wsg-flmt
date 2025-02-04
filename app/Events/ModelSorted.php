<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelSorted
{
    use Dispatchable, SerializesModels;

    public string $model_name;

    /**
     * Create a new event instance.
     */
    public function __construct(string $model_name)
    {
        $this->model_name = $model_name;
    }
}
