<?php

namespace App\Presentation\Controller;

use App\Application\Exceptions\CreateUserException;
use App\Application\User\Commands\CreateUserCommand;
use App\Application\User\Commands\DeleteUserCommand;
use App\Application\User\Commands\Handlers\CreateUserCommandHandler;
use App\Application\User\Commands\Handlers\DeleteUserCommandHandler;
use App\Application\User\Commands\Handlers\UpdateUserCommandHandler;
use App\Application\User\Commands\UpdateUserCommand;
use App\Application\User\UserService;
use App\Presentation\Controller\API\AbstractApiController;
use App\Presentation\Form\CreateUserForm;
use App\Presentation\Form\EditUserForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractApiController
{
    public function __construct(
      private readonly CreateUserCommandHandler $createUserCommandHandler,
      private readonly UpdateUserCommandHandler $updateUserCommandHandler,
      private readonly DeleteUserCommandHandler $deleteUserCommandHandler,
      private readonly UserService $userService
    ) {
    }

    public function create(Request $request): Response
    {
        try {
            $form = $this->buildForm(CreateUserForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $user = $form->getData();

            $this->createUserCommandHandler->handle(
                new CreateUserCommand(
                    $user->getId(),
                    $user->getUsername(),
                    $user->getEmail(),
                )
            );
        } catch (CreateUserException $exception) {

            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Registration was successful'], Response::HTTP_CREATED);
    }

    public function update(Request $request): Response
    {
        try {
            $form = $this->buildForm(EditUserForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $user = $form->getData();

            $this->updateUserCommandHandler->handle(
                new UpdateUserCommand(
                    $user->getId(),
                    $user->getUsername(),
                    $user->getEmail(),
                    $user->getStatus(),
                )
            );
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Edit successful'], Response::HTTP_OK);
    }

    public function delete(Request $request): Response
    {
        $userId = $request->get('id');
        try {
            $this->deleteUserCommandHandler->handle(new DeleteUserCommand($userId));
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        return new JsonResponse(['message' => 'Delete successful'], Response::HTTP_OK);
    }

    public function get(): Response
    {
        return new JsonResponse(
            [
                $this->userService->getUserInfo
                (
                    $this->getUser()->getUserIdentifier()
                )
            ], Response::HTTP_OK);
    }
}