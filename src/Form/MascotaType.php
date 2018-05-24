<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Consulta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('animal')
            ->add('fechanac')
            ->add('cliente',EntityType::class,array(
              'class' => Cliente::class,
              'choice_label' => function ($cliente) {
                  return $cliente->getNombre();
           }))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}
