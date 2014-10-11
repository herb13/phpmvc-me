<?php

/**
 * To attach comments-flow to a page or some content.
 * This class extends the CommentsInSession and adds 
 * support for storing comments with a tag, denoted $key
 * below.
 *
 */

namespace Herb13\Comment;

use Phpmvc\Comment\CommentsInSession;

class CPageCommentsInSession extends CommentsInSession
{
    
    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     * 
     * @return void
     */
    public function addWithKey($comment, $key)
    {
        $comments = $this->session->get($this->createIndexName($key), []);
        $comments[] = $comment;
        $this->session->set($this->createIndexName($key), $comments);
    }



    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    public function findAllWithKey($key)
    {
        return $this->session->get($this->createIndexName($key), []);
    }



    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteAllWithKey($key)
    {
        $this->session->set($this->createIndexName($key), []);
    }

    /**
     * Create session index based on the $key 
     *
     * @return void
     */
    private function createIndexName($key) {

        return 'comments_' . $key;
    }
}