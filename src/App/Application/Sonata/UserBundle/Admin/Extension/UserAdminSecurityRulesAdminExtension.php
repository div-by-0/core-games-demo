<?php

namespace App\Application\Sonata\UserBundle\Admin\Extension;

use App\Application\Sonata\UserBundle\Entity\User;
use Core\UserBundle\Admin\Extension\UserAdminRequireOwnPasswordForPasswordChange;
use Core\UserBundle\Admin\UserAdmin;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * for UserAdmin
 * @see UserAdmin
 */
class UserAdminSecurityRulesAdminExtension extends AbstractAdminExtension
{
    public function configureFormFields(FormMapper $formMapper)
    {
        $user = $formMapper->getAdmin()->getSubject();
        if ($user instanceof User) {
            //TODO: move to core bundle!
            if (in_array('ROLE_CHAT_USER', $user->getRoles())) {
                $formMapper->tab('User')->with('General', ['class' => 'col-md-6']);
                $formMapper->remove('plainPassword');
                $formMapper->add('plainPassword', HiddenType::class, ['required' => false,]);

                if ($formMapper->has(UserAdminRequireOwnPasswordForPasswordChange::FIELD_NAME)) {
                    $formMapper->remove(UserAdminRequireOwnPasswordForPasswordChange::FIELD_NAME);
                }
                $formMapper->end()->end();
            }
        }
    }

    public function configureListFields(ListMapper $listMapper)
    {
    }


    public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context = 'list')
    {

    }

    public function alterObject(AdminInterface $admin, $object)
    {
    }
}
