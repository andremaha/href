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
class RandomStringShortener implements Shortener
{
    public function shorten($original)
    {
        return $this->generateRandomString(6);
    }

    private function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
