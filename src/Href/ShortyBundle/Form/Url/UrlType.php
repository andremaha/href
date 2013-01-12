<?php

namespace Href\ShortyBundle\Form\Url;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UrlType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('original', 'text', array(
            'attr' => array('class' => 'input-xxlarge')
        ));
    }

    public function getName()
    {
        return 'url';
    }

}