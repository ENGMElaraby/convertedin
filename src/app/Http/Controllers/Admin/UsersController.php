<?php

namespace App\Http\Controllers\Admin;

use App\{Http\Controllers\Controller, Repositories\UsersRepository};
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\HttpFoundation\Response;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     * @param UsersRepository $repository
     */
    #[Pure]
    public function __construct(private UsersRepository $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchForUsers(Request $request): Response
    {
        $input = $request->input;
        return new Response(
            data: $this->repository->where('name', "%$input%", 'like')->take(100)->get(),
        );
    }


}
