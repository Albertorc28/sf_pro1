<?php



namespace App\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Consulta;

use Symfony\Component\Form\AbstractType;
use App\Entity\Mascota;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;



class ConsultaType extends AbstractType

{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        $builder

            ->add('titulo')

            ->add('fechahora')

            ->add('descripcion')

            ->add('importe')
            ->add('mascota',EntityType::class,array(
              'class' => Mascota::class,
              'choice_label' => function ($mascota) {
                  return $mascota->getNombre();
           }))

            ->add( 'save' , SubmitType::class , array (

                'attr' => array ( 'class' => 'btn btn-success' ),

            ));

    }



    public function configureOptions(OptionsResolver $resolver)

    {

        $resolver->setDefaults([

            'data_class' => Consulta::class,

        ]);

    }

}
