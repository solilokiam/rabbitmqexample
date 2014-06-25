<?php
namespace Solilokiam\RabbitMQBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;

class MakeThumbnailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('solilokiam:thumbnail:generate')
            ->setDescription('Generates thumbnails of given size in selected folder')
            ->addArgument('origin',InputArgument::REQUIRED,'Origin path of pictures')
            ->addArgument('destination',InputArgument::REQUIRED,'Destination path of pictures')
            ->addOption('width',null,InputOption::VALUE_OPTIONAL,'Width of the thumbnail 300 by default')
            ->addOption('height',null,InputOption::VALUE_OPTIONAL,'Height of the thumbnail 300 by default');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $width = $input->getOption('width')?$input->getOption('width'):300;
        $height = $input->getOption('height')?$input->getOption('height'):300;

        $finder = new Finder();
        $finder
            ->files()
            ->name('*.jpg')
            ->name('*.png')
            ->name('*.gif')
            ->in($input->getArgument('origin'));

        foreach($finder as $file)
        {
            $messageArray = array(
                'original_image_path' => $file->getRealPath(),
                'destination_image_path' => $input->getArgument('destination').'/'.$file->getFileName(),
                'width' => $width,
                'height' => $height
            );

            $this->getContainer()->get('old_sound_rabbit_mq.make_thumbnail_producer')
                ->setContentType('application/json')
                ->setDeliveryMode(2)
                ->publish(json_encode($messageArray));
        }
    }

} 