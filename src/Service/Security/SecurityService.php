<?php

namespace App\Service\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Util\Json\JsonSchemaInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Util\Json\JsonDesarializer;
use SensitiveParameter;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityService
{
    public function __construct(
        private JsonDesarializer $jsonDesarializer,
        private UserRepository $userRepository,
    ) {
    }

    public function authenticateLoginRequest(Request $request): UserInterface
    {
        $data = $this->jsonDesarializer->getData($request->getContent(), new class implements JsonSchemaInterface {
            public function getJsonSchema(): string
            {
                return file_get_contents(__DIR__ . '../Resources/Schemas/login.schema.json');
            }
        });

        $user = $this->getUser($data['username'], $data['password']);

        if (null === $user)
            throw new Exception('User not found or invalid credentials', 401);

        return $user;
    }

    private function getUser(string $username, #[SensitiveParameter] string $password): ?UserInterface
    {
        $user = $this->userRepository->fineOneByUsername($username);

        if (null === $user)
            return null;

        if (password_verify($password, $user->getPassword()))
            return $user;

        return null;
    }
}