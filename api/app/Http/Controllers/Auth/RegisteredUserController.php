<?php

namespace App\Http\Controllers\Auth;

use App\Domain\ChatModule\EntryPoint\RegisterChatUser\RegisterChatUserAction;
use App\Domain\ChatModule\EntryPoint\RegisterChatUser\RegisterChatUserParameters;
use App\Domain\ChatModule\User\Exception\ChatUserAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    private static RegisterChatUserAction $registerChatUserAction;

    public function __construct(RegisterChatUserAction $registerChatUserAction)
    {
        self::$registerChatUserAction = $registerChatUserAction;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = null;

        try {
            DB::transaction(static function() use ($request, &$token) {
                /** @var User $user */
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $registerChatUserParameters = new RegisterChatUserParameters(
                    $user->id,
                    $user->name,
                );

                $token = $user->createToken('auth-token');

                self::$registerChatUserAction->run($registerChatUserParameters);
                event(new Registered($user));

                Auth::login($user);
            });
        } catch (ChatUserAlreadyExistsException $exception) {
            throw ValidationException::withMessages([$exception->getMessage()]);
        }

        return response()->json([
            'token' => $token
        ]);
    }
}
