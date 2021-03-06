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
    }

    public function runCompiler()
    {
        $this->template->compileTitle();
        $this->template->waitingCompile();
        $this->checkPermissionWritableDirectory();
        $this->template->waitingCompile();
        $this->removeAutoloadFile();
        $this->template->waitingCompile();
        $this->generateAutoload();
    }

    public function runPublishAutoloadConfig()
    {
        $this->template->publishAutoloadConfigTitle();
        $this->template->waitingCompile();
        $this->schemaAutoloadPsr4Dom();
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

    private function schemaAutoloadPsr4Dom()
    {
        $generate = $this->generate->preparePublishGenerateAutoload();
        $getAutoloadConfig = $this->generate->getAutoloadConfig();
        $publishGenerate = $this->template->publishAutoload($generate, $getAutoloadConfig);
        $publishGenerate = $this->generate->moveAutoloadConfig($publishGenerate);
        if ($publishGenerate) {
            return $this->template->publishAutoloadSuccessfully();
        } else {
            return $this->template->publishAutoloadUnsuccessfully();
        }
    }
}
