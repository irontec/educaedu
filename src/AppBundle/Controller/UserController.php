<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\RegistrationFormType;
use AppBundle\Form\Model\RegistrationFormModel;

/**
 * MeController.
 */
class UserController extends FOSRestController
{

    /**
     * @Security("is_granted('view', user)")
     * @ApiDoc(
     *   description = "Get your own user.",
     *   statusCodes = {
     *     200 = "Show user info.",
     *     401 = "Authentication failure, user doesn’t have permission or API token is invalid or outdated.",
     *     403 = "Authorizationi failure, user doesn’t have permission to access this area.",
     *   }
     * )
     * 
     * @return array
     */
    public function getUserAction($id)
    {
        $user = $this->container->get('app.api_user_handler')->get($id);

        $view = $this->view($user);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *   description = "Register new user.",
     *   input = "AppBundle\Form\Model\RegistrationFormModel",
     *   output = "AppBundle\Model\UserInterface",
     *   statusCodes = {
     *     200 = "User correctly added.",
     *   }
     * )
     * 
     * @param Request $request
     *
     * @return array
     */
    public function postUserAction(Request $request)
    {
        $user = $this->container->get('app.api_user_handler')->post(
            $request->request->all()
        );
        $view = $this->view($user);
        return $this->handleView($view);
    }
    /**
     * @Security("is_granted('edit', user)")
     * @ApiDoc(
     *   description = "Update own user.",
     *   input = "AppBundle\Form\Model\ProfileFormModel",
     *   output = "AppBundle\Model\UserInterface",
     *   statusCodes = {
     *     200 = "User data updated.",
     *     401 = "Authentication failure, user doesn’t have permission or API token is invalid or outdated.",
     *   }
     * )
     * 
     * @param Request $request
     *
     * @return array
     */
    public function putUserAction(Request $request, $id)
    {
        $user = $this->container->get('app.api_user_handler')->put(
            $id, $request->request->all()
        );

        $view = $this->view($user);
        return $this->handleView($view);
    }
    /**
     * @Security("is_granted('edit', user)")
     * @ApiDoc(
     *   description = "Delete own user.",
     *   statusCodes = {
     *     204 = "Do no return nothing.",
     *     401 = "Authentication failure, user doesn’t have permission or API token is invalid or outdated.",
     *   }
     * )
     * 
     * @return array
     */
    public function deleteUserAction($id)
    {
        $this->container->get('app.api_user_handler')->delete($id);
        $view = $this->view(array());
        return $this->handleView($view);
    }

}
