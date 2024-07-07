<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $success = $this->authService->register($request->all());
            return $this->sendResponse($success, 'Usuário registrado com sucesso');
        } catch (ValidationException $e) {
            return $this->sendError('VALIDATION_ERROR', $e->errors());
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $success = $this->authService->login($request->all());
            return $this->sendResponse($success, 'Login efetuado com sucesso');
        } catch (AuthenticationException $e) {
            return $this->sendError('UNAUTHORISED', ['error' => $e->getMessage()]);
        }
    }
}
