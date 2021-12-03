<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Core\Exception\AppException;
use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ValidationException;
use App\Domain\ChatModule\EntryPoint\CreateRoom\CreateRoomAction;
use App\Domain\ChatModule\EntryPoint\RoomList\RoomInfo;
use App\Domain\ChatModule\EntryPoint\RoomList\RoomListQuery;
use App\Domain\ChatModule\EntryPoint\RoomMessagesList\MessageInfo;
use App\Domain\ChatModule\EntryPoint\RoomMessagesList\RoomMessagesListQuery;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

class ChatController extends Controller
{
    private RoomListQuery $roomListQuery;

    private RoomMessagesListQuery $roomMessagesListQuery;

    private CreateRoomAction $createRoomAction;

    private Serializer $serializer;

    /**
     * @param RoomListQuery $roomListQuery
     * @param RoomMessagesListQuery $roomMessagesListQuery
     * @param CreateRoomAction $createRoomAction
     * @param Serializer $serializer
     */
    public function __construct(
        RoomListQuery         $roomListQuery,
        RoomMessagesListQuery $roomMessagesListQuery,
        CreateRoomAction      $createRoomAction,
        Serializer            $serializer
    )
    {
        $this->roomListQuery = $roomListQuery;
        $this->roomMessagesListQuery = $roomMessagesListQuery;
        $this->createRoomAction = $createRoomAction;
        $this->serializer = $serializer;
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return \response()->json([
            'chats' => $this->roomListQuery->run()->map(fn(RoomInfo $room) => [
                'id' => $room->getRoomId(),
                'name' => $room->getRoomName()
            ])
        ]);
    }

    /**
     * @param int $roomId
     * @return JsonResponse
     */
    public function room(int $roomId): JsonResponse
    {
        $roomMessages = $this->roomMessagesListQuery->run(RoomId::make($roomId));

        return response()->json([
            'roomId' => $roomId,
            'messages' => $roomMessages->map(fn(MessageInfo $message) => [
                'author' => $message->getAuthorName(),
                'text' => $message->getText(),
                'sendTime' => $message->getSendTime()
            ])
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $roomName = $request->input('name', '');

        try {
            $room = $this->createRoomAction->run($roomName);

            $response = new JsonResponse($this->serializer->normalize($room), Response::HTTP_CREATED);
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
