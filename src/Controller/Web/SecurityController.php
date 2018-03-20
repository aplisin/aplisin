<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use App\Form\User\LoginUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package App\Controller\Web
 * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
 */
class SecurityController extends BaseController
{
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginUserType::class, [
            'user[username]' => $lastUsername
        ]);

        return $this->render('web/security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    public function logoutAction()
    {
        throw new \RuntimeException('this should not be reached!');
    }
}