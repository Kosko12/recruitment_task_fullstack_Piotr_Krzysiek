<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ExchangeService;

class DefaultController extends AbstractController
{

    public function index(): Response
    {
        return $this->render(
            'app-root.html.twig'
        );
    }

    public function setupCheck(Request $request): Response
    {
        $responseContent = json_encode([
            'testParam' => $request->get('testParam')
                ? (int) $request->get('testParam')
                : null
        ]);
        return new Response(
            $responseContent,
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }

    public function checkExchangeRate(Request $request, ExchangeService $exchangeService): Response
    {
        $currencies = Currency::list();

        $data = [];

        foreach($currencies as $curr){
            $data[] = $exchangeService->getRates($curr);
        }

        return new JsonResponse(['data' => $data]);
    }
    public function chechExchangeRateHistory(Request $request, ExchangeService $exchangeService): Response
    {
        $currencyCode = $request->get('currency');
        $days = $request->get('days');

        $data = $exchangeService->getSpecificRatesHistory($currencyCode, $days);

        return new JsonResponse(['data' => $data]);
    }

}
