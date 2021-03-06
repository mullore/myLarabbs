<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
         $reply->topic->reply_count = $reply->topic->reply()->count();
         $reply->save();
         $reply->topic->user->notify(new TopicReplied($reply));
    }

    public function creating(Reply $reply)
    {
        //
        $reply->content = clean($reply->content,'user_topic_body');

        $reply->topic->updateReplyCount();
    }

    public function updating(Reply $reply)
    {
        //
    }
    public function deleted(Reply $reply){
        $reply->topic->updateReplyCount();
    }


}
