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

    /**
     * Constructor Class
     * 
     * @var Codenom\Framework\CLI\Component\Template
     * @var Codenom\Framework\CLI\Component\Generate
     */
    public function __construct()
    {
        $this->generate = new Generate();
        $this->template = new Template();
    }

    /**
     * Running Compiler
     * 
     * @var Codenom\Framework\CLI\Component\Template::compileTitle
     * @var Codenom\Framework\CLI\Component\Template::waitingCompile
     * @var checkPermissionWritableDirectory
     * @var removeAutoloadFile
     * @var generateAutoload
     * 
     * @return void
     */
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

    /**
     * Publish Autoload config
     * 
     * @var Codenom\Framework\CLI\Component\Template::publicAutoloadConfigTitle
     * @var Codenom\Framework\CLI\Component\Template::waitingCompile
     * @var schemaAutoloadPsr4Dom
     * @return void
     */
    public function runPublishAutoloadConfig()
    {
        $this->template->publishAutoloadConfigTitle();
        $this->template->waitingCompile();
        $this->schemaAutoloadPsr4Dom();
    }

    /**
     * Check permission folder writable directory
     * 
     * @var Codenom\Framework\CLI\Component\Template::waitingCompile
     * @var Codenom\Framework\CLI\Component\Template::checkFolderPermissionTitle
     * @var Codenom\Framework\CLI\Component\Generate::checkPermissionWritableDirectory
     * @var Codenom\Framework\CLI\Component\Generate::successfullyCheckPermissionFolder
     * @var Codenom\Framework\CLI\Component\Generate::unsuccessfullyCheckPermissionFolder
     * @return bool
     */
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

    /**
     * Remove Autoload File old
     * 
     * @var Codenom\Framework\CLI\Component\Generate::removeGenerateAutoload
     * @var Codenom\Framework\CLI\Template\Template::successfullyRemoveAutoload
     * @return mixed
     */
    private function removeAutoloadFile()
    {
        if ($this->generate->removeGenerateAutoload())
            return $this->template->successfullyRemoveAutoload();
        // } else {
        //     $this->template->unsuccessfullyRemoveAutoload();
        // }
    }

    /**
     * Generate new Autoload
     * 
     * @var Codenom\Framework\CLI\Component\Template::contentAutoloadGenerate
     * @var Codenom\Framework\CLI\Component\Generate::fileCreate
     * @var Codenom\Framework\CLI\Component\Template::waitingCompile
     * @var Codenom\Framework\CLI\Component\Template::successfullyGenerateAutoload
     * @var Codenom\Framework\CLI\Component\Template::unsuccessfullyGenerateAutoload
     * @return mixed
     */
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

    /**
     * DOM Schema Autoload PSR-4
     * 
     * @var Codenom\Framework\CLI\Component\Generate::preparePublishGenerateAutoload
     * @var Codenom\Framework\CLI\Component\Generate::getAutoloadConfig
     * @var Codenom\Framework\CLI\Component\Generate::moveAutoloadConfig
     * @var Codenom\Framework\CLI\Component\Template::publishAutoloadSuccessfully
     * @var Codenom\Framework\CLI\Component\Template::publishAutoloadUnsuccessfully
     * @return mixed
     */
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
