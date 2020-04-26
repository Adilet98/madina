<?php

namespace App\Form;

use App\Entity\Plan;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Дата',
            ])
            ->add('topic', TextType::class, [
                'label' => 'Сабақ тақырыбы'
            ])
            ->add('homework', ChoiceType::class, [
                'label' => 'Үй жұмысы',
                'choices' => [
                    'Иә' => true,
                    'Жоқ' => false
                ]
            ])
            ->add('notes', TextType::class, [
                'label' => 'Ескертпелер'
            ])
            ->add('teacher', EntityType::class, [
                'label' => 'Мұғалім',
                'class' => Teacher::class,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Сақтау'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plan::class,
        ]);
    }
}
