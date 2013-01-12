<?php
namespace Href\ShortyBundle\Shorteners;

use Href\ShortyBundle\Shorteners\Shortener;

/**
 * Simple URL shortener
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     href
 * @version     0.1
 */
class SimpleShortener implements Shortener
{
    public function shorten($original)
    {
        return substr(str_shuffle(md5($original)), 0, 6);
    }

}
