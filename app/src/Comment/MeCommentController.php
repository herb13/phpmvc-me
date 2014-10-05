<?php

/**
 * To attach comments-flow to a page or some content. This class extends 
 * the CommentController. Actually all methods are overridden, so this could be
 * an entirerly own class. 
 *
 */

namespace Herb13\Comment;

use Phpmvc\Comment\CommentController;
use Herb13\Comment\MeCommentsInSession;

class MeCommentController extends CommentController
{

    private $pageUrl = null;

    /*****************************************************************************
     * This methods sets the page that this controller should be added to.
     * The $pageUrl is used when saving data into the session.
     * @param $pageUrl, the page that the comments are added t
     *
     */

    public function setPage($pageUrl) {

        $this->pageUrl = $pageUrl;
    }

    /*****************************************************************************
     * This methods shows all comments for the particular page (as set in $pageUrl)
     * @param $id the id of data to be edited. It's the order that the comment is
     *            saved in the session, i.e. 0, 1, ..., N
     *
     */
       
    public function viewAction()
    {
        // Create the session to get access to the comments
        // Inject the dependencies (di)

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);

        // Set views for text and also display a form for
        // adding new comments

        $this->views->add('comment/index');
        $this->views->add('comment/form', [
            'mail'      => null,
            'web'       => null,
            'name'      => null,
            'content'   => null,
            'output'    => null,
            'pageUrl'   => $this->pageUrl,
        ]);

        // Get all the comments for this particular page

        $all = $comments->findAllWithKey($this->pageUrl);

        // Set view for showing all comments. Pass on the comments
        // and the pageUrl for redirection to correct controller/page

        $this->views->add('comment/comments', [
            'comments' => $all,
            'pageUrl'  => $this->pageUrl,
        ]);
    }

    /*****************************************************************************
     * This methods adds a comment for the page specified in setPage
     * @param -
     *
     */

    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Save all data from the user into a comment array

        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        // Create the session to get access to the comments
        // Inject the dependencies (di)

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);

        // Add the comment to the particular page

        $comments->addWithKey($comment, $this->pageUrl);

        // Redirect to the page saved in post by the form

        $this->response->redirect($this->request->getPost('redirect'));
    }


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

        // Create the session to get access to the comments
        // Inject the dependencies (di)

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);

        // Fetch all comments for the particular page

        $allComments = $comments->findAllWithKey($this->pageUrl);

        // Search for the comment to edit.
        // It will be accessable via commentToAdd

        $commentToEdit = null;
        $i = 0;
        foreach ($allComments as $comment) {
            
            if($i == $id) { // Find correct id to edit

                $commentToEdit = $comment;
                break;
            }
            $i++;
        }

        // Set title for the page

        $this->theme->setTitle("Editera inlägg");
        
        // Create data for the view. It's an edit form with
        // data that already exists for the comment

        $this->views->add('comment/index');
        $this->views->add('comment/edit', [
            'content'   => $commentToEdit['content'],
            'name'      => $commentToEdit['name'],
            'web'       => $commentToEdit['web'],
            'mail'      => $commentToEdit['mail'],
            'output'    => null,
            'id'        => $id,
            'pageUrl'   => $this->pageUrl,
        ]);
    }


    /*****************************************************************************
     * This method updates a specific comment identified by $id. The $id is the
     * the position in the array that the comments is saved in. 
     * @param $id, the position in which the comment is stored, 0, 1, 2, ... , N
     *
     */

    public function updateAction($id) {

        $isPosted = $this->request->getPost('doUpdate');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Object for comments in session, so that we can access 
        // all available comments. Fetch all comments.

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);
        $allComments = $comments->findAllWithKey($this->pageUrl);

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

        $comments->deleteAllWithKey($this->pageUrl);

        foreach($allComments as $comment)
        {
            $comments->addWithKey($comment, $this->pageUrl);    
        }

        // Redirect to the page saved in post by the form

        $this->response->redirect($this->request->getPost('redirect'));
    }


    /*****************************************************************************
     * This method deletes a specific comment identified by $id. The $id is the
     * the position in the array that the comments is saved in. 
     * @param $id, the position in which the comment is stored, 0, 1, 2, ... , N
     *
     */

    public function deleteAction($id) {

        $isPosted = $this->request->getPost('doDelete');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }


        // Initiate the session. It's here we save all data and read out all
        // comments so far. Then delete the one with $id and write them back

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);
        $allComments = $comments->findAllWithKey($this->pageUrl);

        $comments->deleteAllWithKey($this->pageUrl);

        $i = 0;
        foreach ($allComments as $comment) {
            
            if($i != $id) { // We just skip the one with id

                $comments->addWithKey($comment, $this->pageUrl);
            }
            $i++;
        }

        // Redirect to the page saved in post by the form

        $this->response->redirect($this->request->getPost('redirect'));   
    }

    /*****************************************************************************
     * This method removes all comments for a specific page as set in setPage().
     * @param -
     *
     */

    public function removeAllAction()
    {
        $isPosted = $this->request->getPost('doRemoveAll');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Create the session to get access to the comments
        // Inject the dependencies (di)

        $comments = new MeCommentsInSession();
        $comments->setDI($this->di);

        // Delete all comments for the particular page

        $comments->deleteAllWithKey($this->pageUrl);

        // Redirect to the page saved in post by the form

        $this->response->redirect($this->request->getPost('redirect'));
    }
}
