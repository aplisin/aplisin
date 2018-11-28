<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * Checking to see if a User is Logged In
     *
     * @return bool
     */
    protected function isLogin(): bool
    {
        return $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
    }

    /**
     * @param array /messages $messages
     *
     * @return string
     */
    protected function trans(array $messages): string
    {
        return $this->get('translator')->trans($messages);
    }

    /**
     * @param string|null $data
     * @param int         $status
     * @param array       $headers
     *
     * @return JsonResponse
     */
    protected function createJsonResponse(string $data = null, int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }
}
