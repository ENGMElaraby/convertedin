<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Support\Facades\DB};

class DashboardController extends Controller
{

    public function __construct(private UsersRepository $repository)
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $users = $this->repository->getTop10UsersWithTasks();
        return view('admin.dashboard', compact('users'));
    }

}