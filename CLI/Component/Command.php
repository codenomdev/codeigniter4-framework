<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\CLI\Component;

class Command
{
    /**
     * @var Codenom\Framework\CLI\Component\Template
     */
    protected $template;

    /**
     * @var Codenom\Framework\CLI\Component\Generate
     */
    protected $generate;

    public function __construct()
    {
        $this->generate = new Generate();
        $this->template = new Template();
        $this->template->compileTitle();
        $this->template->waitingCompile();
        $this->checkPermissionWritableDirectory();
        $this->removeAutoloadFile();
        $this->generateAutoload();
        $this->template->waitingCompile();
    }

    private function checkPermissionWritableDirectory()
    {
        $this->template->waitingCompile();
        $this->template->checkFolderPermissionTitle();
        $this->template->waitingCompile();
        if (!\is_null($this->generate->checkPermissionWritableDirectory())) {
            $this->template->waitingCompile();
            return $this->template->successfullyCheckPermissionFolder();
        } else {
            $this->template->waitingCompile();
            return $this->template->unsuccessfullyCheckPermissionFolder();
        }
    }

    private function removeAutoloadFile()
    {
        if ($this->generate->removeGenerateAutoload())
            return $this->template->successfullyRemoveAutoload();
        // } else {
        //     $this->template->unsuccessfullyRemoveAutoload();
        // }
    }

    private function generateAutoload()
    {
        $createSchema = $this->template->contentAutoloadGenerate($this->generate->getNameModule());
        if ($this->generate->fileCreate($createSchema)) {
            $this->template->waitingCompile();
            return $this->template->successfullyGenerateAutoload();
        } else {
            $this->template->waitingCompile();
            return $this->template->unsuccessfullyGenerateAutoload();
        }
    }
}
