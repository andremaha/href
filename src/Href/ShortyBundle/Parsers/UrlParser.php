<?php

namespace Href\ShortyBundle\Parsers;

class UrlParser
{

    private $url;

    public function __construct($url)
    {
        $this->url = parse_url($url);
    }

    public function getDomain()
    {
        return $this->parseDomain($this->url);
    }

    public function getTld()
    {
        return $this->parseTld($this->url);
    }

    private function parseDomain($pieces)
    {
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }

    function parseTld($url_parts)
    {
        $host_parts = explode( '.', $url_parts['host'] );
        return array_pop( $host_parts );
    }

}