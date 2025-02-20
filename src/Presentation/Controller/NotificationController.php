<?php

namespace App\Presentation\Controller;

use App\Application\Notification\Commands\CreateNotificationCommand;
use App\Application\Notification\Commands\Handlers\CreateNotificationCommandHandler;
use App\Application\Notification\Commands\Handlers\UpdateNotificationCommandHandler;
use App\Application\Notification\Commands\UpdateNotificationCommand;
use App\Presentation\Controller\API\AbstractApiController;
use App\Presentation\Form\CreateNotificationForm;
use App\Presentation\Form\EditNotificationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends AbstractApiController
{

    public function __construct(
       private readonly CreateNotificationCommandHandler $createNotificationCommandHandler,
       private readonly UpdateNotificationCommandHandler $updateNotificationCommandHandler,
    ){
    }

    public function create(Request $request): Response
    {
        try {
            $form = $this->buildForm(CreateNotificationForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $notification = $form->getData();
            $this->createNotificationCommandHandler->handle(
                new CreateNotificationCommand(
                    $notification->getType(),
                    $notification->getMessage(),
                    $notification->getStatus(),
                    $notification->getUserId(),
                )
            );
        } catch (\Exception $exception)
        {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        return new JsonResponse(['message' => 'Notification created'], Response::HTTP_CREATED);
    }

    public function update(Request $request): Response
    {
        try {
            $form = $this->buildForm(EditNotificationForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $notification = $form->getData();
            $this->updateNotificationCommandHandler->handle(
                new UpdateNotificationCommand(
                    $notification->getId(),
                    $notification->getStatus()
                )
            );
        } catch (\Exception $exception)
        {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        return new JsonResponse(['message' => 'Notification edited'], Response::HTTP_OK);
    }
}