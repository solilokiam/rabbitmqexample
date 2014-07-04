<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 29/06/14
 * Time: 16:33
 */

namespace Solilokiam\RabbitMQBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StringReverseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('solilokiam:string:reverse')
            ->setDescription('Reverses string and prints it on screen')
            ->addArgument('reversable_string',InputArgument::REQUIRED,'String to reverse');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reversableString = $input->getArgument('reversable_string');

        $message_array = array(
            'string' => $reversableString
        );

        $client = $this->getContainer()->get('old_sound_rabbit_mq.string_reverser_rpc');

        $requestIdentifier = microtime();

        $client->addRequest(json_encode($message_array),'string_reverse',$requestIdentifier);

        $requestIdentifier2 = microtime();

        $client->addRequest(json_encode($message_array),'string_capitalize',$requestIdentifier2);

        $replies=$client->getReplies();

        $output->writeln($replies[$requestIdentifier]);
        $output->writeln($replies[$requestIdentifier2]);
    }


} 