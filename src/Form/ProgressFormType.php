<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgressFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quarterOne', IntegerType::class, [
                'label' => '1-ші тоқсан',
                'required' => false
            ])
            ->add('quarterTwo', IntegerType::class, [
                'label' => '2-ші тоқсан',
                'required' => false
            ])
            ->add('quarterThree', IntegerType::class, [
                'label' => '3-ші тоқсан',
                'required' => false
            ])
            ->add('quarterFour', IntegerType::class, [
                'label' => '4-ші тоқсан',
                'required' => false
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Жылдық',
                'required' => false
            ])
            ->add('exam', IntegerType::class, [
                'label' => 'Экзамен',
                'required' => false
            ])
            ->add('final', IntegerType::class, [
                'label' => 'Қорытынды',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Сақтау'
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
