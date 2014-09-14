<?php

/**
 * To attach comments-flow to a page or some content.
 *
 */

namespace Herb13\Comment;

use Phpmvc\Comment\CommentController;
use Phpmvc\Comment\CommentsInSession;

class MeCommentController extends CommentController
{


    /*****************************************************************************
     * This methods shows the edit form with form data that can be edited.
     * @param $id the id of data to be edited. It's the order that the comment is
     *            saved in the session, i.e. 0, 1, ..., N
     *
     */

    public function editAction($id) {

        $isPosted = $this->request->getPost('doEdit');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Fetch data from session and display it in the form

        $comments = new CommentsInSession();
        $comments->setDI($this->di);
        $allComments = $comments->findAll();

        $commentToEdit = null;
        $i = 0;
        foreach ($allComments as $comment) {
            
            if($i == $id) { // Find correct id to edit

                $commentToEdit = $comment;
                break;
            }
            $i++;
        }

        $this->theme->setTitle("Editera inlägg");

        $this->views->add('comment/index');

        $this->views->add('comment/edit', [
            'content'   => $commentToEdit['content'],
            'name'      => $commentToEdit['name'],
            'web'       => $commentToEdit['web'],
            'mail'      => $commentToEdit['mail'],
            'output'    => null,
            'id'        => $id,
        ]);


        $this->dispatcher->forward([
            'controller' => 'comment',
            'action'     => 'view',
        ]);

    }


    /*****************************************************************************
     *
     *
     *
     */

    public function updateAction($id) {

        $isPosted = $this->request->getPost('doUpdate');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Object for comments in session, so that we can access 
        // all available comments. Fetch all comments.

        $comments = new CommentsInSession();
        $comments->setDI($this->di);
        $allComments = $comments->findAll();

        // Fetch the specific comment that needs to be updated.
        // The id gives the comment that should be updated

        $commentToUpdate = $allComments[$id];

        // Update it with data from the rquest (post)

        $commentToUpdate['content'] = $this->request->getPost('content');
        $commentToUpdate['name'] = $this->request->getPost('name');
        $commentToUpdate['web'] = $this->request->getPost('web');
        $commentToUpdate['mail'] = $this->request->getPost('mail');
        
        // Write back the updated comment to the array with all
        // comments

        $allComments[$id] = $commentToUpdate;

        // Write back the comments to comments in session. First delete the
        // existing comments. Otherwise we would just append the added comments

        $comments->deleteAll();

        foreach($allComments as $comment)
        {
            $comments->add($comment);    
        }

        $this->response->redirect($this->request->getPost('redirect'));
    }


    /*****************************************************************************
     *
     *
     *
     */

    public function deleteAction($id) {

        $isPosted = $this->request->getPost('doDelete');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }


        // Initiate the session. It's here we save all data and read out all
        // comments so far. Then delete the one with $id and write them back

        $comments = new CommentsInSession();
        $comments->setDI($this->di);
        $allComments = $comments->findAll();

        $comments->deleteAll();

        $i = 0;
        foreach ($allComments as $comment) {
            
            if($i != $id) { // We just skip the one with id

                $comments->add($comment);
            }
            $i++;
        }

        $this->response->redirect($this->request->getPost('redirect'));   

    }
}
