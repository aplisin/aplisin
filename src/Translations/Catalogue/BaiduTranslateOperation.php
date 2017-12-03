<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Translations\Catalogue;

use App\Service\Translate\BaiduTranslateService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\Catalogue\AbstractOperation;
use Symfony\Component\Translation\MessageCatalogueInterface;

/**
 * Merge operation between two catalogues as follows:
 * all = source ∪ target = {x: x ∈ source ∨ x ∈ target}
 * new = all ∖ source = {x: x ∈ target ∧ x ∉ source}
 * obsolete = source ∖ all = {x: x ∈ source ∧ x ∉ source ∧ x ∉ target} = ∅
 * Basically, the result contains messages from both catalogues.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class BaiduTranslateOperation extends AbstractOperation
{
    private $container;

    public function __construct(MessageCatalogueInterface $source, MessageCatalogueInterface $target, ContainerInterface $container)
    {
        parent::__construct($source, $target);

        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    protected function processDomain($domain)
    {
        $this->messages[$domain] = array(
            'all' => array(),
            'new' => array(),
            'obsolete' => array(),
        );

        foreach ($this->source->all($domain) as $id => $message) {
            $this->messages[$domain]['all'][$id] = $message;
            $this->result->add(array($id => $message), $domain);
            if (null !== $keyMetadata = $this->source->getMetadata($id, $domain)) {
                $this->result->setMetadata($id, $keyMetadata, $domain);
            }
        }

        foreach ($this->target->all($domain) as $id => $message) {
            if (!$this->source->has($id, $domain)) {
                $this->messages[$domain]['all'][$id] = $message;
                $this->messages[$domain]['new'][$id] = $message;
                $message = $this->getBaiduTranslateService()->translate($message, $this->target->getLocale());
                $this->result->add(array($id => $message), $domain);

                if (null !== $keyMetadata = $this->target->getMetadata($id, $domain)) {

                    $this->result->setMetadata($id, $keyMetadata, $domain);
                }
            }
        }
    }

    protected function getBaiduTranslateService()
    {
        return $this->container->get('service.translate.baidu_translate_service');
    }
}
