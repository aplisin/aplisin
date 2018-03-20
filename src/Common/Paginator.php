<?php

namespace App\Common;

use Doctrine\ORM\Tools\Pagination\Paginator as BasePaginator;

class Paginator extends BasePaginator
{
    protected $baseUrl;

    public function setBaseUrl($url)
    {
        $template = '';

        $urls = parse_url($url);
        $template .= empty($urls['scheme']) ? '' : $urls['scheme'].'://';
        $template .= $urls['host'] ?? '';
        $template .= $urls['path'] ?? '';

        isset($urls['query']) ? parse_str($urls['query'], $queries) : $queries = [];
        $queries['page'] = '..page..';
        $template .= '?'.http_build_query($queries);

        $this->baseUrl = $template;
    }

    public function getPageUrl($page)
    {
        return str_replace('..page..', $page, $this->baseUrl);
    }
}