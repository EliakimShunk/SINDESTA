<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{FiliadoService, TransactionService};
use Framework\TemplateEngine;

class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private FiliadoService $filiadoService)
    {
    }
    public function homeold(string $subject)
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 10;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionService->getUserTransactions(
            $length,
            $offset
        );

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm,
            ]),
            $pages
        );

        echo $this->view->render("/index.php", [
            'transactions' => $transactions,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm
        ]);
    }
    public function home()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 10;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? null;
        $filterMonth = $_GET['f'] ?? null;

        [$filiados, $count] = $this->filiadoService->getAllFiliados(
            $length,
            $offset
        );

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm,
                'f' => $filterMonth
            ]),
            $pages
        );

        echo $this->view->render("/index.php", [
            'filiados' => $filiados,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm,
                'f' => $filterMonth
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm,
                'f' => $filterMonth
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm,
            'filterMonth' => $filterMonth
        ]);
    }
}