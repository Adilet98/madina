<?php

namespace App\Form;

use App\Entity\ClassGroup;
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
                'label' => 'Аты'
            ])
            ->add('lastname', null, [
                'label' => 'Әкесінің аты'
            ])
            ->add('position', null, [
                'label' => 'Қызметі'
            ])
            ->add('category', null, [
                'label' => 'Категориясы'
            ])
            ->add('user', EntityType::class, [
                'label' => 'Қолданушы',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return $qb->andWhere($qb->expr()->like('u.roles', '?1'))
                        ->setParameter(1, '%ROLE_TEACHER%')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => 'username'
            ])
            ->add('groupNames', EntityType::class, [
                'label' => 'Сыныптар',
                'class' => ClassGroup::class,
                'multiple' => true,
                'expanded' => true
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
