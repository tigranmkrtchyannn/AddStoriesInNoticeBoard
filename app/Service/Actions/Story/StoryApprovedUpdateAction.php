<?php

namespace App\Service\Actions\Story;

use App\Events\StoryEvent;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class StoryApprovedUpdateAction
{
    public $storyRepository;

    public function __construct(StoryRepositoryInterface $storyRepositoryInterface)
    {
        $this->storyRepository = $storyRepositoryInterface;
    }

    public function run(string $token)
    {
        $story = $this->storyRepository->getStoryByToken($token);

        if (!Cache::get('STORY_APPROVAL_TOKEN_' . $token)) {
            throw new \RuntimeException('Story approval token is expired');
        }
        $this->storyRepository->updateApproved($story);
        event(new StoryEvent($story));

        return $story;
    }

}
