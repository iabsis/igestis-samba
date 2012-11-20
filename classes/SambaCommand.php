<?php

namespace Igestis\Modules\Samba;

/**
 * Description of command
 *
 * @author gilles
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class SambaCommand extends Command {
    private $input;
    private $output;
    
    /**
     * Configure the shell arguments
     */
    protected function configure()
    {
        $this
            ->setName('Samba:generatePassword')
            ->setDescription('Generate a samba crypted password from the given plain text.')
            ->addArgument(
                'plain',
                InputArgument::REQUIRED,
                'Password to encrypt ?'
            );
    }

    /**
     * Execute the shell script to parse the archiver configured folders
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        
        $plainPassword = $input->getArgument('plain');
        if($plainPassword) {
            $output->writeln("User password:" . '{MD5}' . base64_encode(pack('H*', md5($plainPassword))));
            $sambapassword = new smbHash;
            $output->writeln("LM password:" . $sambapassword->lmhash($plainPassword));
            $output->writeln("NT password:" . $sambapassword->nthash($plainPassword));
        }

    }
    
    private function writeLn($msg) {
        if($this->input->getOption("verbose")) {
            $this->output->writeln($msg);
        }
    }
}

?>
