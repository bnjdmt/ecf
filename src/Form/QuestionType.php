<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $question = $options['data'];

        $builder
            ->add('questionText', HiddenType::class)
            ->add('choices', ChoiceType::class, [
                'choices' => $question->getChoices(),
                'choice_label' => function ($choice, $key, $value) {
                    return $value; // Retourne la clé comme étiquette
                },
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('correctAnswer', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
