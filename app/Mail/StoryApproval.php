<?php

namespace App\Mail;

use App\Models\Story;
use Illuminate\Mail\Mailable;

class StoryApproval extends Mailable
{
    public $story;
    public $approvalLink;
    public function __construct(Story $story, $approvalLink)
    {
        $this->story = $story;
        $this->approvalLink = $approvalLink;
    }

    public function build(): StoryApproval
    {
        return $this->view('story_approval')
            ->with([
                'storyTitle' => $this->story->title,
                'storyDescription' => $this->story->description,
                'approvalLink' => $this->approvalLink,
            ]);
    }
}
