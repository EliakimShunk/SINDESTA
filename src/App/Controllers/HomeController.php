<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{FiliadoService};
use Framework\TemplateEngine;

class HomeController
{

    public function __construct(
        private TemplateEngine $oView,
        private FiliadoService $oFiliadoService)
    {
    }
    public function home()
    {
        $iPage = $_GET['p'] ?? 1;
        $iPage = (int) $iPage;
        $iLength = 10;
        $iOffset = ($iPage - 1) * $iLength;
        $mSearchTerm = $_GET['s'] ?? null;
        $mFilterMonth = $_GET['f'] ?? null;

        [$aFiliados, $iCount] = $this->oFiliadoService->getAllFiliados(
            $iLength,
            $iOffset
        );


        $iLastPage = ceil($iCount / $iLength);

        $aPages = $iLastPage ? range(1, $iLastPage) : [];

        $aPageLinks = array_map(
            fn($iPageNum) => http_build_query([
                'p' => $iPageNum,
                's' => $mSearchTerm,
                'f' => $mFilterMonth
            ]),
            $aPages
        );


        echo $this->oView->render("/index.php", [
            'aFiliados' => $aFiliados,
            'iCurrentPage' => $iPage,
            'aPreviousPageQuery' => http_build_query([
                'p' => $iPage - 1,
                's' => $mSearchTerm,
                'f' => $mFilterMonth
            ]),
            'iLastPage' => $iLastPage,
            'aNextPageQuery' => http_build_query([
                'p' => $iPage + 1,
                's' => $mSearchTerm,
                'f' => $mFilterMonth
            ]),
            'aPageLinks' => $aPageLinks,
            'mSearchTerm' => $mSearchTerm,
            'mFilterMonth' => $mFilterMonth
        ]);
    }
}