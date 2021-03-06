<?php

/**
 *
 * @author Pierre Feyssaguet <pfeyssaguet@gmail.com>
 * @since 10/11/15 08:35
 */

namespace DspSofts\CronManagerBundle\Form;

use Doctrine\ORM\EntityRepository;
use DspSofts\CronManagerBundle\Entity\CronTask;
use DspSofts\CronManagerBundle\Entity\Search\CronTaskLogSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CronTaskLogSearchType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CronTaskLogSearch::class,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateStart', DatePickerType::class)
            ->add('cron_task', EntityType::class, array(
                'class' => CronTask::class,
                'placeholder' => 'Tout',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('cronTask')
                        ->orderBy('cronTask.name');
                },
                'required' => false,
            ))
            ->add('search', SubmitType::class);
    }
}
