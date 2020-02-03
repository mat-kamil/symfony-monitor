<?php

namespace App\Controller;

use App\Repository\ServerLoadRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServerLoadController
{
    private $serverLoadRepository;

    public function __construct(ServerLoadRepository $serverLoadRepository)
    {
        $this->serverLoadRepository = $serverLoadRepository;
    }

    /**
     * Route("/server-load", name="fetch-all", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request){
        $data = $this->serverLoadRepository->findAll();
        return new JsonResponse(['data' => $data], Response::HTTP_OK);
    }
}
