<?php
declare(strict_types=1);



namespace App\Backend\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Forms\ProfilesForm;
use App\Models\Profiles;

/**
 * Base\Controllers\ProfilesController
 * CRUD to manage profiles
 */
class ProfilesController extends ControllerBase
{
    /**
     * Default action. Set the private (authenticated) layout
     * (layouts/private.volt)
     */
    public function initialize(): void
    {
    }

    /**
     * Default action, shows the search form
     */
    public function indexAction(): void
    {
        $this->persistent->conditions = null;
        $this->view->setVar('form', new ProfilesForm(null));
    }

    /**
     * Searches for profiles
     */
    public function searchAction()
    {
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, Profiles::class, $this->request->getPost());
            $searchparams = $query->getParams();
            unset($searchparams['di']);
            $this->persistent->searchParams = $searchparams;
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $profiles = Profiles::find($parameters);
        if (count($profiles) == 0) {
            $this->flash->notice("The search did not find any profiles");

            return $this->dispatcher->forward([
                "action" => "index",
            ]);
        }

        $paginator = new Paginator([
            'model' => Profiles::class,
            'parameters' => $parameter,
            'limit' => 10,
            'page' => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->setVar('page', $paginator->paginate());
    }

    /**
     * Creates a new Profile
     */
    public function createAction(): void
    {
        if ($this->request->isPost()) {
            $profile = new Profiles([
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active'),
            ]);

            if (!$profile->save()) {
                foreach ($profile->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }
            } else {
                $this->flash->success("Profile was created successfully");
            }
        }

        $this->view->setVar('form', new ProfilesForm(null));
    }

    /**
     * Edits an existing Profile
     *
     * @param int $id
     */
    public function editAction($id)
    {
        $profile = Profiles::findFirstById($id);
        if (!$profile) {
            $this->flash->error("Profile was not found");
            return $this->dispatcher->forward([
                'action' => 'index',
            ]);
        }

        if ($this->request->isPost()) {
            $profile->assign([
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active'),
            ]);

            if (!$profile->save()) {
                foreach ($profile->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }
            } else {
                $this->flash->success("Profile was updated successfully");
            }
        }

        $this->view->setVars([
            'form' => new ProfilesForm(null, ['edit' => true]),
            'profile' => $profile,
        ]);
    }

    /**
     * Deletes a Profile
     *
     * @param int $id
     */
    public function deleteAction($id)
    {
        $profile = Profiles::findFirstById($id);
        if (!$profile) {
            $this->flash->error("Profile was not found");

            return $this->dispatcher->forward([
                'action' => 'index',
            ]);
        }

        if (!$profile->delete()) {
            foreach ($profile->getMessages() as $message) {
                $this->flash->error((string)$message);
            }
        } else {
            $this->flash->success("Profile was deleted");
        }

        return $this->dispatcher->forward([
            'action' => 'index',
        ]);
    }
}
