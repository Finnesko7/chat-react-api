<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Chat;

use App\Core\Exception\AppException;
use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ValidationException;
use App\Domain\ChatModule\EntryPoint\CreateRoom\CreateRoomAction;
use App\Domain\ChatModule\EntryPoint\RoomList\RoomListQuery;
use App\Domain\ChatModule\EntryPoint\RoomMessagesList\RoomMessagesListQuery;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

class ChatController extends Controller
{
    private RoomListQuery $roomListQuery;
    private RoomMessagesListQuery $roomMessagesListQuery;
    private CreateRoomAction $createRoomAction;
    private Serializer $serializer;

    public function __construct(
        RoomListQuery $roomListQuery,
        RoomMessagesListQuery $roomMessagesListQuery,
        CreateRoomAction $createRoomAction,
        Serializer $serializer
    ) {
        $this->roomListQuery = $roomListQuery;
        $this->roomMessagesListQuery = $roomMessagesListQuery;
        $this->createRoomAction = $createRoomAction;
        $this->serializer = $serializer;
    }

    public function list(): View
    {
        return \view('chats', ['chats' => $this->roomListQuery->run()]);
    }

    public function room(int $roomId): View
    {
        $roomMessages = $this->roomMessagesListQuery->run(RoomId::make($roomId));
        return \view('room', ['roomId' => $roomId, 'messages' => $roomMessages]);
    }

    public function create(Request $request): Response
    {
        try {
            $roomName = $request->input('name', '');
            $room = $this->createRoomAction->run($roomName);
            $response = new JsonResponse($this->serializer->normalize($room), Response::HTTP_CREATED);
        } catch (\Throwable $exception) {
            $statusCode = $exception instanceof AppException ||
            $exception instanceof BusinessLogicException ||
            $exception instanceof ValidationException
                ? Response::HTTP_BAD_REQUEST : Response::HTTP_INTERNAL_SERVER_ERROR;
            $response = new JsonResponse(['errors' => [$exception->getMessage()]], $statusCode);
        }

        return $response;
    }
}
