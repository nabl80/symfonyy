<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles')
            ->add('password')
            ->add('email');

//        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
//            function ($rolesAsArray) {
//                return implode(', ', $rolesAsArray);
//            },
//            function ($rolesAsString) {
//                return explode(', ', $rolesAsString);
//            }
//        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
