<?php

namespace Href\ShortyBundle\Shorteners;

interface Shortener
{
    public function shorten($original);
}