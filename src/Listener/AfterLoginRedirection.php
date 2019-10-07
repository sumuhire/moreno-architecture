<?php

namespace App\Listener;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 *
 * @package AppBundle\AppListener
 */
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);
        
        /**
         * 
         */
        if (in_array('ROLE_MORENO', $rolesTab, true)) {
            
            // c'est un aministrateur : on le rediriger vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('dashboard'));
        }
       
        // } elseif (in_array('ROLE_SCHOOL_USER_ADMIN', $rolesTab, true)) {
            
        //     // c'est un utilisaeur lambda : on le rediriger vers l'accueil
        //     $redirection = new RedirectResponse($this->router->generate('education'));
        
        // } elseif (in_array('ROLE_GRADUATE_USER', $rolesTab, true)) {
            
        //     // c'est un utilisaeur lambda : on le rediriger vers l'accueil
        //     $redirection = new RedirectResponse($this->router->generate('profile'));
        
        // }else{
        //     // c'est un utilisaeur lambda : on le rediriger vers l'accueil
        //     $redirection = new RedirectResponse($this->router->generate('login'));
        // }

        return $redirection;
    }
}