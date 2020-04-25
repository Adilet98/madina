<?php

namespace App\Form;

use App\Entity\ClassGroup;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Doctrine\ORM\QueryBuilder;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', null, [
                'label' => 'Фамилия'
            ])
            ->add('firstname', null, [
                'label' => 'Аты'
            ])
            ->add('lastname', null, [
                'label' => 'Әкесінің аты'
            ])
            ->add('shift', null, [
                'label' => 'Оқу формасы'
            ])
            ->add('groupName', EntityType::class, [
                'label' => 'Сынып',
                'class' => ClassGroup::class,
                'choice_label' => 'name'
            ])
            ->add('birth', DateType::class, [
                'label' => 'Туған күні',
                'years' => range(1980, 2010)
            ])
            ->add('address', null, [
                'label' => 'Адрес'
            ])
            ->add('user', EntityType::class, [
                'label' => 'Қолданушы',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return $qb->andWhere($qb->expr()->like('u.roles', '?1'))
                        ->setParameter(1, '%ROLE_STUDENT%')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => 'username'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
