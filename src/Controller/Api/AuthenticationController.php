<?php

namespace App\Controller\Api;

use App\Service\Security\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/auth")]
final class AuthenticationController extends AbstractController
{
    #[Route("/login")]
    public function login(
        Request $request,
        SecurityService $securityService,
    ) {

    }
}