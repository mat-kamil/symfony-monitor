<?php

namespace App\Controller;

use App\Repository\ServerLoadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class ServerLoadController extends AbstractController
{
    private $serverLoadRepository;
    private const isoRegex = "/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))/";

    public function __construct(ServerLoadRepository $serverLoadRepository)
    {
        $this->serverLoadRepository = $serverLoadRepository;
    }

    /**
     * @Route("/", name="default", methods={"GET"})
     */
    public function index() {
        return $this->render('homepage.html.twig');
    }

    /**
     * Get all ServerLoad from server
     * Request can have 2 params, from & to, both which if supplied will be an ISO date
     * @Route("/api/server-load", name="get_server_loads", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request){
        $from = null;
        $to = null;
        $fromDate = $request->query->get('from');
        $toDate = $request->query->get('to');
        $cb = $request->query->get('callback');

        if($fromDate && preg_match(self::isoRegex, $fromDate)) {
            $from = new DateTime($fromDate);
        }
        if($toDate && preg_match(self::isoRegex, $toDate)) {
            $to = \DateTime::createFromFormat('Y-m-d\TH:i:s.vP', $toDate);
        }

        $data = $this->serverLoadRepository->fetchQuery($from, $to);
        $response = new JsonResponse(['data' => $data], Response::HTTP_OK);

        if($cb) { $response->setCallback($cb); }
        return $response;
    }
}
