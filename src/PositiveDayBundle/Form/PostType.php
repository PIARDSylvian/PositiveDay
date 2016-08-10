<?php

namespace PositiveDayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->remove('date', 'datetime')
            ->add('note', ChoiceType::class, array('choices' => array(
                                                                        '1' => '1',
                                                                        '2' => '2',
                                                                        '3' => '3',
                                                                        '4' => '4',
                                                                        '5' => '5',
                                                                    ),
                                                                    'required'    => false,
                                                                    'placeholder' => 'Attribuer une note',
                                                                    'empty_data'  => '3'))
            ->remove('user')
            ->add('Poster', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PositiveDayBundle\Entity\Post'
        ));
    }
}
