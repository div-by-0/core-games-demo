<?php


namespace App\Application\Sonata\UserBundle\Security\Factory;


use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;

//TODO: refactor to core user bundle
class CustomFormLoginFactory extends FormLoginFactory
{
    protected function getListenerId()
    {
        return 'App\Application\Sonata\UserBundle\Security\UsernamePasswordRecaptchaFormAuthenticationListener';//TODO:
    }

    public function getKey()
    {
        return 'custom-form-login';
    }



}
