<?php

namespace App\Presentation\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateNoteForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The title field must not be blank',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'The given title is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('content', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The content field must not be blank',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'The given content is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('version', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The version field must not be blank',
                    ]),
                    new Length([
                        'max' => 64,
                        'maxMessage' => 'The given version is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ]);
    }
}