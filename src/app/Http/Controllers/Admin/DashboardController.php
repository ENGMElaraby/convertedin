<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View};

class DashboardController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('admin.dashboard');
    }

}