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
        return $this->parseDomain($this->url['host']);
    }

    public function getTld()
    {
        return $this->parseTld($this->url);
    }

    private function parseDomain($domainb)
    {
        $bits = explode('/', $domainb);
        if ($bits[0]=='http:' || $bits[0]=='https:')
        {
            $domainb= $bits[2];
        } else {
            $domainb= $bits[0];
        }
        unset($bits);
        $bits = explode('.', $domainb);
        $idz=count($bits);
        $idz-=3;
        if (strlen($bits[($idz+2)])==2) {
            $url=$bits[$idz].'.'.$bits[($idz+1)].'.'.$bits[($idz+2)];
        } else if (strlen($bits[($idz+2)])==0) {
            $url=$bits[($idz)].'.'.$bits[($idz+1)];
        } else {
            $url=$bits[($idz+1)].'.'.$bits[($idz+2)];
        }
        return $url;
    }

    function parseTld($url_parts)
    {
        $host_parts = explode( '.', $url_parts['host'] );
        return array_pop( $host_parts );
    }

}