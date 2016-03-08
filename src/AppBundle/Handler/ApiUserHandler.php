<?php

namespace AppBundle\Handler;

use AppBundle\Model\UserRepository;
use AppBundle\Model\UserInterface;
use AppBundle\Form\Type\RegistrationFormType;
use AppBundle\Form\Model\RegistrationFormModel;
use AppBundle\Form\Type\ProfileFormType;
use AppBundle\Form\Model\ProfileFormModel;
use AppBundle\Form\Model\UserFormModelInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormError;

/**
 * ApiUserHandler.
 */
class ApiUserHandler implements ApiUserHandlerInterface
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * Init Handler.
     * 
     * @param UserRepository       $repository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(UserRepository $repository, FormFactoryInterface $formFactory)
    {
        $this->repository = $repository;
        $this->formFactory = $formFactory;
    }

    /**
     * Get user from repository.
     * 
     * @param User $user
     *
     * @return User
     */
    public function get(UserInterface $user)
    {
        return $this->repository->parse($user);
    }

    /**
     * Insert User to repository.
     * 
     * @param array $params
     *
     * @return User
     */
    public function post(array $params)
    {
        $userModel = RegistrationFormModel::fromArray($params);
        $form = $this->formFactory->create(RegistrationFormType::class, $userModel, array('method' => 'POST'));
        $form->submit($params);

        if ($form->isValid()) {
            try {
                $rawUser = $this->insertFromForm($form->getData());

                $user = $this->repository->insert($rawUser);

                return $this->repository->parse($user);
            } catch (\Exception $ex) {
                //  throw new $ex;
                $form->addError(new FormError('Duplicate entry for email or username.'));
                // log this somewhere.
            }
        }

        return $form;
    }

    /**
     * Update User to repository.
     * 
     * @param array $params
     *
     * @return type
     */
    public function put($id, array $params)
    {
        $userModel = ProfileFormModel::fromArray($params);

        $form = $this->formFactory->create(ProfileFormType::class, $userModel, array('method' => 'POST'));
        $form->submit($params);

        if ($form->isValid()) {
            $user = $this->updateFromForm($id, $form->getData());

            $this->repository->update();

            return $this->repository->parse($user);
        }

        return $form;
    }

    /**
     * Delete User.
     * 
     * @param User $user
     */
    public function delete(UserInterface $user)
    {
        $this->repository->remove($user);
    }

    /**
     * @param ProfileFormModel $userModel
     *
     * @return User
     */
    protected function insertFromForm(UserFormModelInterface $userModel)
    {
        $user = $this->repository->findNew();

        $user
            ->setUsername($userModel->getUsername())
            ->setUsernameCanonical($userModel->getUsername())
            ->setPlainPassword($userModel->getPlainPassword())
        ;

        return $this->fromForm($user, $userModel);
    }

    /**
     * @param type             $id
     * @param ProfileFormModel $userModel
     *
     * @return User
     */
    protected function updateFromForm($id, UserFormModelInterface $userModel)
    {
        $user = $this->repository->find($id);

        $user->setDescription($userModel->getDescription());

        return $this->fromForm($user, $userModel);
    }

    /**
     * @param User             $user
     * @param ProfileFormModel $userModel
     *
     * @return User
     */
    protected function fromForm(UserInterface $user, UserFormModelInterface $userModel)
    {
        $user
            ->setEmailCanonical($userModel->getEmail())
            ->setEmail($userModel->getEmail())
        ;

        return $user;
    }
}
