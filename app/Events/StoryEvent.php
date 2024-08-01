<?php

namespace App\Events;

use App\Models\Story;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected string $title;
    protected string $description;

    public function __construct(Story $story)
    {
        $this->title = $story->title;
        $this->description = $story->description;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('noticeboard'),
        ];
    }

    public function broadcastWith(): array
    {
        return ['title' => $this->title, 'description' => $this->description];
    }
}

