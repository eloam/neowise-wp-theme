<?php

namespace NwComponents;

use NwComponents\Options;
use NwComponents\Utilities;
use NwComponents\Enums\FileTypes;

class ComponentInfo {
    
    private $id;
    private $name;
    private $className;
    private $fullName;
    private $relativePath;
    private $path;
    private $uri;
    private $canLoad;
    private $hasScriptFile;
    private $hasStyleFile;
    private $handleScriptName;
    private $handleStyleName;
    private $options;
    private $throwErrors;

    public function __get($property) {
        if ($property == 'id')               { return $this->id; }               else
        if ($property == 'name')             { return $this->name; }             else
        if ($property == 'className')        { return $this->className; }        else
        if ($property == 'fullName')         { return $this->fullName; }         else
        if ($property == 'relativePath')     { return $this->relativePath; }     else
        if ($property == 'path')             { return $this->path; }             else
        if ($property == 'uri')              { return $this->uri; }              else
        if ($property == 'canLoad')          { return $this->canLoad; }          else
        if ($property == 'hasScriptFile')    { return $this->hasScriptFile; }    else
        if ($property == 'hasStyleFile')     { return $this->hasStyleFile; }     else
        if ($property == 'handleScriptName') { return $this->name . '-script'; } else
        if ($property == 'handleStyleName')  { return $this->name . '-style'; }  else
        if ($property == 'options')          { return $this->options; }
    }

    public function __construct(string $relativeComponentPath, Options $options, bool $throwErrors = false) {
        $this->id = uniqid();
        $this->canLoad = false;
        $this->hasScriptFile = false;
        $this->hasStyleFile = false;
        $this->options = $options;
        $this->throwErrors = $throwErrors;

        $this->determinePaths($relativeComponentPath);
        $this->determineNames();
        $this->checkFullPaths();
    }

    private function determinePaths(string $relativeComponentPath) {

        $relativeComponentPath = Utilities::formatPath($relativeComponentPath);

        $this->relativePath = $this->options->componentsDirectoryPath . '/' . $relativeComponentPath;
        $this->path = get_template_directory() . '/' . $this->relativePath;
        $this->uri = get_template_directory_uri() . '/' . $this->relativePath;
    }

    private function determineNames() {

        $explodePath = explode('/', $this->relativePath);
        $componentName = $explodePath[count($explodePath) - 1];

        if (!preg_match('/^(?!.*--)([a-zA-Z0-9])([a-zA-Z0-9-]+)([a-zA-Z0-9])$/', $componentName)) {
            if ($this->throwErrors) {
                throw new \Exception(sprintf('Component name (%s) is invalid. This name must follow the following rules : Alphanumeric characters with hyphens (except at the beginning, at the end or consecutive)', $componentName));
            }
            return;
        }

        $this->name = $componentName;
        $this->fullName = $componentName . '-component';
        $this->className = str_replace('-', '', implode('-', array_map('ucfirst', explode('-', $this->fullName))));
    }

    private function checkFullPaths() {
        
        // Vérification de l'existance du répertoire du composant
        if (!file_exists($this->path)) {
            if ($this->throwErrors) {
                throw new \Exception(sprintf('Component path is invalid. (Path: %s )', $this->path));
            }
            return;
        }

        if (file_exists($this->getFilePath(FileTypes::php))) {
            $this->canLoad = true;
        } else {
            if ($this->throwErrors) {
                throw new \Exception(sprintf('PHP file component not found. (File: %s)', $this->getFilePath(FileTypes::php)));
            }
            return;
        }

        if (file_exists($this->getFilePath(FileTypes::js))) {
            $this->hasScriptFile = true;
        }

        if (file_exists($this->getFilePath(FileTypes::css))) {
            $this->hasStyleFile = true;
        }
    }

    public function getFileName(string $extension) {
        return $this->fullName . $extension;
    }

    public function getFileRelativePath(string $extension) {
        $fileName = $this->getFileName($extension);
        return $this->relativePath . '/' . $fileName;
    }

    public function getFilePath(string $extension) {
        $fileName = $this->getFileName($extension);
        return $this->path . '/' . $fileName;
    }

    public function getFileUri($extension) {
        $fileName = $this->getFileName($extension);
        return $this->uri . '/' . $fileName;
    }
}