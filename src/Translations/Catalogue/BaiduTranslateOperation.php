<?php

namespace App\Translations\Catalogue;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\Catalogue\AbstractOperation;
use Symfony\Component\Translation\MessageCatalogueInterface;

class BaiduTranslateOperation extends AbstractOperation
{
    protected $container;

    protected $clean;

    /**
     * {@inheritDoc}
     */
    public function __construct(MessageCatalogueInterface $source, MessageCatalogueInterface $target, ContainerInterface $container, $clean = false)
    {
        $this->container = $container;
        $this->clean = $clean;
        parent::__construct($source, $target);
    }

    /**
     * Performs operation on source and target catalogues for the given domain and
     * stores the results.
     *
     * @param string $domain The domain which the operation will be performed for
     */
    protected function processDomain($domain)
    {
        $this->messages[$domain] = array(
            'all' => array(),
            'new' => array(),
            'obsolete' => array(),
        );

        if ($this->clean) {
            foreach ($this->source->all($domain) as $id => $message) {
                if ($this->target->has($id, $domain)) {
                    $this->resultAdd($domain, $id, $message);
                } else {
                    $this->messages[$domain]['obsolete'][$id] = $message;
                }
            }
        } else {
            foreach ($this->source->all($domain) as $id => $message) {
                $this->resultAdd($domain, $id, $message);
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

    protected function resultAdd($domain, $id, $message)
    {
        $this->messages[$domain]['all'][$id] = $message;
        $this->result->add(array($id => $message), $domain);
        if (null !== $keyMetadata = $this->source->getMetadata($id, $domain)) {
            $this->result->setMetadata($id, $keyMetadata, $domain);
        }
    }

    protected function getBaiduTranslateService()
    {
        return $this->container->get('app.service.translate.baidu_translate_service');
    }
}