<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Produks\ProduksService;
use App\Services\ProduksGrade\ProduksGradeService;

class PageController extends Controller
{
    protected $produksService;
    protected $produksGradeService;
    public function __construct(ProduksService $produksService, ProduksGradeService $produksGradeService)
    {
        $this->produksService = $produksService;
        $this->produksGradeService = $produksGradeService;
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }

    public function product()
    {
        $products = $this->produksService->getAllProduksForTable();
        $grades = $this->produksGradeService->getAllProduksGrade();
        return view("pages.product", compact('products', 'grades'));
    }

    public function produksDetail($id)
    {
        $product = $this->produksService->find($id);
        $product->load(['grade', 'production']);
        return view('pages.product-detail', compact('product'));
    }

    public function inventory()
    {
        return view("pages.inventory");
    }
}
