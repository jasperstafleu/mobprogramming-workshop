<?php

namespace DevelopersNL\Controller;

use DevelopersNL\Model\PostgresRepository;
use DevelopersNL\Model\User;
use DevelopersNL\Request\Request;
use DevelopersNL\Response\RedirectResponse;
use DevelopersNL\Response\ResponseInterface;

class RegisterController
{
    public function __construct(
        protected PostgresRepository $repository
    )
    {
    }

    public function createNewUser(Request $request): ResponseInterface
    {
        $input = $request->parsedBody;
        $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
        $input['secretQuestionAnswer'] = password_hash($input['secretQuestionAnswer'], PASSWORD_BCRYPT);

        $this->repository->store(new User(...$input));

        return new RedirectResponse('/', 303);
    }
}
