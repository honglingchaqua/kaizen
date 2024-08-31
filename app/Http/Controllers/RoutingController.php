<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class RoutingController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Menampilkan halaman berdasarkan apakah pengguna sudah login atau belum.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function index(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Menampilkan view berdasarkan parameter route pertama
     *
     * @param \Illuminate\Http\Request $request
     * @param string $first
     * @return ViewFactory|ViewContract|RedirectResponse
     */
    public function root(Request $request, string $first): ViewFactory|ViewContract|RedirectResponse
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');
     
        if ($first === "assets") {
            return redirect()->route('home');
        }

        return view($first, ['mode' => $mode, 'demo' => $demo]);
    }

    /**
     * Menampilkan view berdasarkan parameter route pertama dan kedua
     *
     * @param \Illuminate\Http\Request $request
     * @param string $first
     * @param string $second
     * @return ViewFactory|ViewContract|RedirectResponse
     */
    public function secondLevel(Request $request, string $first, string $second): ViewFactory|ViewContract|RedirectResponse
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first === "assets") {
            return redirect()->route('home');
        }

        return view($first . '.' . $second, ['mode' => $mode, 'demo' => $demo]);
    }

    /**
     * Menampilkan view berdasarkan parameter route pertama, kedua, dan ketiga
     *
     * @param \Illuminate\Http\Request $request
     * @param string $first
     * @param string $second
     * @param string $third
     * @return ViewFactory|ViewContract|RedirectResponse
     */
    public function thirdLevel(Request $request, string $first, string $second, string $third): ViewFactory|ViewContract|RedirectResponse
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first === "assets") {
            return redirect()->route('home');
        }

        return view($first . '.' . $second . '.' . $third, ['mode' => $mode, 'demo' => $demo]);
    }
}
