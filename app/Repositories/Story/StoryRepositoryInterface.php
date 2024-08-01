<?php

namespace App\Repositories\Story;

use App\Models\Story;

interface StoryRepositoryInterface
{
    public function store(array $data);
   public function getApprovedStories();
   public function getStoryByToken(string $token);
   public function updateApproved(Story $story);
   public function getNewApprovedStories($approvedFrom,$approvedTo);

}
