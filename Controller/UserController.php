<?php

namespace Bigfoot\Bundle\UserBundle\Controller;

use Bigfoot\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\EventDispatcher\GenericEvent;

use Bigfoot\Bundle\CoreBundle\Controller\CrudController;
use Bigfoot\Bundle\UserBundle\Event\UserEvent;

/**
 * User controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/user")
 */
class UserController extends CrudController
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'admin_user';
    }

    /**
     * @return string
     */
    protected function getEntity()
    {
        return 'BigfootUserBundle:User';
    }

    protected function getFields()
    {
        return array(
            'id' => array(
                'label' => 'ID',
            ),
            'username' => array(
                'label' => 'Username',
            ),
        );
    }

    protected function getFilters()
    {
        return array(
            array(
                'placeholder' => 'Username',
                'name'        => 'username',
                'type'        => 'referer',
                'options' => array(
                    'property' => 'username'
                )
            )
        );
    }

    protected function getFormType()
    {
        return UserType::class;
    }

    public function getEntityLabel()
    {
        return 'User';
    }

    /**
     * Lists User entities.
     *
     * @Route("/", name="admin_user")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        return $this->doIndex($request);
    }

    /**
     * New User entity.
     *
     * @Route("/new", name="admin_user_new")
     */
    public function newAction(Request $request)
    {
        return $this->doNew($request);
    }

    /**
     * Edit User entity.
     *
     * @Route("/edit/{id}", name="admin_user_edit")
     */
    public function editAction(Request $request, $id)
    {
        return $this->doEdit($request, $id);
    }

    /**
     * Delete User entity.
     *
     * @Route("/delete/{id}", name="admin_user_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        return $this->doDelete($request, $id);
    }

    /**
     * PrePersist User entity.
     */
    protected function prePersist($user, $action)
    {
        $this->getEventDispatcher()->dispatch(UserEvent::UPDATE_PROFILE, new GenericEvent($user));
    }

    /**
     * Post flush entity
     *
     * @param object $user user
     */
    protected function postFlush($user, $action)
    {
        $this->getEventDispatcher()->dispatch(UserEvent::REFRESH_USER, new GenericEvent($user));
    }
}
