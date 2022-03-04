<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('date_debut')
            ->add('date_fin')
            ->add('journee_entiere')
            ->add('chevauchable')
            ->add('modifiable')
            ->add('accepte')
            ->add('en_fond')
            ->add('reccurent')
            ->add('date_debut_recurrence')
            ->add('date_fin_recurrence')
            ->add('jours_recurrence')
            ->add('matiere')
            ->add('intervenant')
            ->add('specialite')
            ->add('formation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
