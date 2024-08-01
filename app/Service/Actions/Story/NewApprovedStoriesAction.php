<?php

namespace App\Service\Actions\Story;

use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;

class NewApprovedStoriesAction
{
    public $storyRepository;
    public function __construct(StoryRepositoryInterface $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }
    public function run(Request $request)
    {
        $approvedFrom = $request->get('approvedFrom');
        $approvedTo = $request->get('approvedTo');

        return $this->storyRepository->getNewApprovedStories($approvedFrom, $approvedTo);
    }
}
