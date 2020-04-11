<?php

namespace App\Form;

use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', null, [
                'label' => 'Фамилия'
            ])
            ->add('firstname', null, [
                'label' => 'Имя'
            ])
            ->add('lastname', null, [
                'label' => 'Отчество'
            ])
            ->add('position', null, [
                'label' => 'Должность'
            ])
            ->add('category', null, [
                'label' => 'Категория'
            ])
            ->add('user', EntityType::class, [
                'label' => 'Пользователь',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return $qb->andWhere($qb->expr()->like('u.roles', '?1'))
                        ->setParameter(1, '%ROLE_TEACHER%')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => 'username'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
