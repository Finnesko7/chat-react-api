<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Chat;

use App\Core\Exception\AppException;
use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ValidationException;
use App\Domain\ChatModule\EntryPoint\SendMessage\SendMessageAction;
use App\Domain\ChatModule\EntryPoint\SendMessage\SendMessageParameters;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

class MessageController extends Controller
{
    private SendMessageAction $sendMessageAction;

    private Serializer $serializer;

    /**
     * @param SendMessageAction $sendMessageAction
     * @param Serializer $serializer
     */
    public function __construct(
        SendMessageAction $sendMessageAction,
        Serializer $serializer
    ) {
        $this->sendMessageAction = $sendMessageAction;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function send(Request $request): Response
    {
        $roomId = (int) $request->input('roomId', 0);
        $userId = (int) Auth::id();
        $text = $request->input('text', '');

        try {
            $sendMessageParameters = new SendMessageParameters($roomId, $userId, $text);

            $message = $this->sendMessageAction->run($sendMessageParameters);

            $response = new JsonResponse($this->serializer->normalize($message), Response::HTTP_CREATED);
        } catch (\Throwable $exception) {
            $statusCode = $this->retrieveStatusCode($exception);

            $response = new JsonResponse(['errors' => [$exception->getMessage()]], $statusCode);
        }

        return $response;
    }

    /**
     * @param \Throwable $exception
     * @return int
     */
    private function retrieveStatusCode(\Throwable $exception): int
    {
        return $exception instanceof AppException ||
        $exception instanceof BusinessLogicException ||
        $exception instanceof ValidationException
            ? Response::HTTP_BAD_REQUEST : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
