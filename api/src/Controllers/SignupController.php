<?php

namespace SignupFormTest\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SignupFormTest\Framework\Controller;
use SignupFormTest\Framework\Output\OutputResponse;
use SignupFormTest\Helpers\Validation\Validator;
use SignupFormTest\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        $request = Request::createFromGlobals();

        return OutputResponse::send('Hello world!');
    }

    public function create()
    {
        $request = Request::createFromGlobals();

        $errors = Validator::validate($request, [
            'email' => 'required',
            'email_confirm' => 'required|equals:email',
            'password' => 'required',
            'password_confirm' => 'required|equals:password',
            'nome' => 'required'
        ]);

        if (count($errors)) {
            return OutputResponse::send($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = new User();
        $user->setEmail($request->request->get('email'));
        $user->setPassword(password_hash($request->request->get('password'), PASSWORD_DEFAULT));

        $this->psql->persist($user);
        $this->psql->flush();

        return OutputResponse::send('User created!');
    }

    public function verifyEmail()
    {
        $request = Request::createFromGlobals();

        $errors = Validator::validate($request, [
            'email' => 'required'
        ]);

        if (count($errors)) {
            return OutputResponse::send($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = new User();
        $user->setEmail($request->request->get('email'));
        $user->setPassword(password_hash($request->request->get('password'), PASSWORD_DEFAULT));

        $this->psql->persist($user);
        $this->psql->flush();

        return OutputResponse::send('User created!');
    }
}
