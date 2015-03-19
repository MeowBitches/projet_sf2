<?php
namespace MeowBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpoilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manga', 'text')
            ->add('title')
            ->add('file', 'file')
        ;
    }

    public function __constructor($formname)
    {
        $this->name = $formname;
        parent::__construct();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MeowBundle\Entity\Spoil',
        ));
    }

    public function getName()
    {
        return 'spoil_form';
    }
}