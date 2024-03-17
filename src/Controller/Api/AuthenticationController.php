<?php

namespace App\Controller\Api;

use App\Service\Security\SecurityService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

#[Route("/api/auth")]
final class AuthenticationController extends AbstractController
{
    #[Route("/login", methods: ["POST"])]
    public function login(
        Request $request,
        SecurityService $securityService,
        JWTManager $jwtManager,
    ) {
        try {
            $user = $securityService->authenticateLoginRequest($request);
            $jwtManager->create($user);
        } catch (Throwable $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}