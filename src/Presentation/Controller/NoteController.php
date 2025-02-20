<?php

namespace App\Presentation\Controller;

use App\Application\Note\Commands\CreateNoteCommand;
use App\Application\Note\Commands\DeleteNoteCommand;
use App\Application\Note\Commands\DeleteUserNoteCommand;
use App\Application\Note\Commands\Handlers\CreateNoteCommandHandler;
use App\Application\Note\Commands\Handlers\DeleteNoteCommandHandler;
use App\Application\Note\Commands\Handlers\DeleteUserNoteCommandHandler;
use App\Application\Note\Commands\Handlers\UpdateNoteCommandHandler;
use App\Application\Note\Commands\UpdateNoteCommand;
use App\Presentation\Controller\API\AbstractApiController;
use App\Presentation\Form\CreateNoteForm;
use App\Presentation\Form\EditNoteForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends AbstractApiController
{

    public function __construct(
        private readonly  CreateNoteCommandHandler $createNoteCommandHandler,
        private readonly UpdateNoteCommandHandler $updateNoteCommandHandler,
        private readonly DeleteNoteCommandHandler $deleteNoteCommandHandler,
        private readonly DeleteUserNoteCommandHandler $deleteUserNoteCommandHandler
    ){
    }

    public function create(Request $request): Response
    {
        try {
            $form = $this->buildForm(CreateNoteForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $note = $form->getData();

            $this->createNoteCommandHandler->handle(
                new CreateNoteCommand(
                    $note->getTitle(),
                    $note->getContent(),
                    $note->getVersion(),
                    $note->getUserId(),
                )
            );
        } catch (\Exception $exception) {

            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Note created'], Response::HTTP_CREATED);
    }

    public function update(Request $request): Response
    {
        try {
            $form = $this->buildForm(EditNoteForm::class);
            $form->handleRequest($request);
            if (!$form->isSubmitted() || !$form->isValid()) {
                return $this->respond($form, Response::HTTP_BAD_REQUEST);
            }

            $note = $form->getData();

            $this->updateNoteCommandHandler->handle(
                new UpdateNoteCommand(
                    $note->getId(),
                    $note->getTitle(),
                    $note->getContent(),
                    $note->getVersion()
                )
            );
        } catch (\Exception $exception) {

            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Note edited'], Response::HTTP_OK);
    }

    public function delete(Request $request): Response
    {
        $noteId = $request->get('id');
        try {
            $this->deleteNoteCommandHandler->handle(new DeleteNoteCommand($noteId));
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        return new JsonResponse(['message' => 'Delete note successful'], Response::HTTP_OK);
    }

    public function deleteByUser(Request $request): Response
    {
        $noteId = $request->get('id');
        try {
            $this->deleteUserNoteCommandHandler->handle(new DeleteUserNoteCommand($noteId, $this->getUser()->getId()));
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        return new JsonResponse(['message' => 'Delete note by user successful'], Response::HTTP_OK);
    }
}