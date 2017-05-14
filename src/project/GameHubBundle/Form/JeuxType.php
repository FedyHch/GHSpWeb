<?php

namespace project\GameHubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuxType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')

            ->add('genre', ChoiceType::class, array(
            'choices' => array
            ('FPS' =>'FPS',
                'MMoRPG'=>'MMoRPG',
                'aventure'=>'aventure',
                'strategie'=>'strategie',
                'infiltration'=>'infiltration',
                'plateforme'=>'plateforme',
                'arcade'=>'arcade',
                'combat'=>'combat',
                'course'=>'course',
                'RPG'=>'RPG',
                'moba'=>'moba',
                'action'=>'action',

            ),

        ))->add('note')->add('description',TextareaType::class)->add('dateSortie')
            ->add('classification', ChoiceType::class, array(
                'choices' => array
                (
                    'PEGI 3'=>'PEGI 3',
                    'PEGI 7'=>'PEGI 7',
                    'PEGI 12'=>'PEGI 12',
                    'PEGI 16'=>'PEGI 16',
                    'PEGI 18'=>'PEGI 18',
                ),
                ))
            ->add('mode', ChoiceType::class, array(
                'choices' => array
                ('Solo' =>'Solo',
                    'Multijoueurs'=>'Multijoueurs',
                    'solo/multi'=>'solo/multi',
                ),
            ))

            ->add('prix')
            ->add('affiche', FileType::class,  array('label' => 'affiche'))


            ->add('trailer')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'project\GameHubBundle\Entity\Jeux'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'project_gamehubbundle_jeux';
    }


}
