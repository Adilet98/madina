<?php

namespace App\Form;

use App\DBAL\Types\DayEnumType;
use App\DBAL\Types\LessonTimeEnumType;
use App\Entity\Cabinet;
use App\Entity\ClassGroup;
use App\Entity\Schedule;
use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', ChoiceType::class, [
                'choices' => DayEnumType::getChoices(),
                'label' => 'Күн'
            ])
            ->add('lessonTime', ChoiceType::class, [
                'choices' => LessonTimeEnumType::getChoices(),
                'label' => 'Сабақ реті'
            ])
            ->add('teacher', EntityType::class, [
                'class' => Teacher::class,
                'label' => 'Мұғалім'
            ])
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'label' => 'Пән'
            ])
            ->add('classGroup', EntityType::class, [
                'class' => ClassGroup::class,
                'label' => 'Сынып'
            ])
            ->add('cabinet', EntityType::class, [
                'class' => Cabinet::class,
                'label' => 'Кабинет'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Сақтау'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
