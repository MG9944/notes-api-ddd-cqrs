<?php

namespace App\Presentation\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateNotificationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The type field must not be blank',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'The given type is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('message', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The message field must not be blank',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'The given message is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('status', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'The status field must not be blank',
                    ]),
                    new Length([
                        'max' => 64,
                        'maxMessage' => 'The given status is too long. It should have less than {{ limit }} characters.',
                    ]),
                ],
            ]);
    }
}