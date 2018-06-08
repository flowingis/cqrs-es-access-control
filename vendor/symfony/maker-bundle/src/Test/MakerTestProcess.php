<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\MakerBundle\Test;

use Symfony\Component\Process\Process;

/**
 * @author Sadicov Vladimir <sadikoff@gmail.com>
 *
 * @internal
 */
final class MakerTestProcess
{
    private $process;

    private function __construct($commandLine, $cwd, $timeout)
    {
        $this->process = new Process($commandLine, $cwd, null, null, $timeout);
        $this->process->inheritEnvironmentVariables();
    }

    public static function create($commandLine, $cwd, $timeout = null): self
    {
        return new self($commandLine, $cwd, $timeout);
    }

    public function setEnv($env): self
    {
        $this->process->setEnv($env);

        return $this;
    }

    public function setInput($input): self
    {
        $this->process->setInput($input);

        return $this;
    }

    public function run($allowToFail = false): self
    {
        $this->process->run();

        if (!$this->process->isSuccessful() && !$allowToFail) {
            throw new \Exception(sprintf(
                'Error running command: "%s". Output: "%s". Error: "%s"',
                $this->process->getCommandLine(),
                $this->process->getOutput(),
                $this->process->getErrorOutput()
            ));
        }

        return $this;
    }

    public function isSuccessful()
    {
        return $this->process->isSuccessful();
    }

    public function getOutput()
    {
        return $this->process->getOutput();
    }

    public function getErrorOutput()
    {
        return $this->process->getErrorOutput();
    }
}