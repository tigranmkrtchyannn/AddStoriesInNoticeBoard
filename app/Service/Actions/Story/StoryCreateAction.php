<?php

namespace App\Service\Actions\Story;

use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Support\Str;

class StoryCreateAction
{
    public $storyRepository;
    public function __construct(StoryRepositoryInterface $storyRepositoryInterface)
    {
        $this->storyRepository = $storyRepositoryInterface;
    }

    public function run(array $data)
    {
        $storyToken = Str::random(32);
        $data['token'] = $storyToken;
        $story = $this->storyRepository->store($data);

        return $story;
    }
}
