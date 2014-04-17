<?php

namespace Bigfoot\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Bigfoot\Bundle\CoreBundle\Controller\CrudController;

/**
 * Role controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/role")
 */
class RoleController extends CrudController
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'bigfoot_role';
    }

    /**
     * @return string
     */
    protected function getEntity()
    {
        return 'BigfootUserBundle:Role';
    }

    public function getEntityLabel()
    {
        return 'User role';
    }

    protected function getFields()
    {
        return array(
            'id'    => 'ID',
            'label' => 'Label'
        );
    }

    protected function getFormType()
    {
        return 'bigfoot_role';
    }

    /**
     * List Role entities.
     *
     * @Route("/", name="bigfoot_role")
     */
    public function indexAction()
    {
        return $this->doIndex();
    }
    /**
     * New Role entity.
     *
     * @Route("/new", name="bigfoot_role_new")
     */
    public function newAction(Request $request)
    {
        return $this->doNew($request);
    }

    /**
     * Edit Role entity.
     *
     * @Route("/edit/{id}", name="bigfoot_role_edit")
     */
    public function editAction(Request $request, $id)
    {
        return $this->doEdit($request, $id);
    }

    /**
     * Delete Role entity.
     *
     * @Route("/delete/{id}", name="bigfoot_role_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        return $this->doDelete($request, $id);
    }
}
