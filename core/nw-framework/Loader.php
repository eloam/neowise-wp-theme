<?php

namespace NwComponents;

use NwComponents\Enums\FileTypes;

class Loader {

    // Singleton pattern
    private static $instance;

    // Properties
    private $instantiatedComponents;


    private function __construct() {
        $this->instantiatedComponents = [];
    }

    public static function context(): Loader {
        if (!self::$instance) {
            self::$instance = new Loader();
        }

        return self::$instance;
    }

    public function resolve(LazyComponent $component) {

        // On vérifie si on peut appeler le composant
        if (!$component->info->canLoad) { return; }

        $loadComponentFiles = !$this->hasInstantiatedSibling($component->info->name);

        $componentInstance = $this->includeComponentTemplate($component, $loadComponentFiles);
        if ($loadComponentFiles) {
            $this->includeComponentScript($component, $loadComponentFiles);
            $this->includeComponentStyle($component, $loadComponentFiles);
            $this->setInstantiatedComponent($component->info->name);
        }
        $this->initializeScriptCtor($component, $componentInstance->viewData);
    }
    
    private function hasInstantiatedSibling($name) {
        if (in_array($name, $this->instantiatedComponents)) {
            return true;
        }

        return false;
    }

    private function includeComponentTemplate(LazyComponent $component, bool $loadComponentFiles): Component {
        // Gestion des classes CSS additionnels
        $class = $component->info->class ? ' ' . $component->info->class : '';

        // Inclusion du fichier PHP et instanciation de l'objet composant par réflection
        echo "<div class=\"component {$component->info->fullName}{$class}\" data-id=\"{$component->info->id}\" data-name=\"{$component->info->name}\">";
        if ($loadComponentFiles) {
            get_template_part($component->info->relativePath . '/' . $component->info->fullName);
        }

        // Inclusion du fichier PHP et instanciation de l'objet composant par réflection
        $reflectionClass = new \ReflectionClass($component->info->className);
        $componentInstance = $reflectionClass->newInstanceArgs([$component->info, $component->data]);
        echo "</div>";

        return $componentInstance;
    }

    private function includeComponentScript(LazyComponent $component) {
        if ($component->info->hasScriptFile) {
            wp_enqueue_script(
                $handle = $component->info->handleScriptName,
                $src = $component->info->getFileUri(FileTypes::js),
                $in_footer = true
            );
        }
    }

    private function includeComponentStyle(LazyComponent $component) {
        if ($component->info->hasStyleFile) {
            wp_enqueue_style(
                $handle = $component->info->handleStyleName,
                $src = $component->info->getFileUri(FileTypes::css)
            );
        }
    }

    private function setInstantiatedComponent($name) {
        // On ajoute le composant à la liste des composants instancié
        array_push($this->instantiatedComponents, $name);
    }

    private function initializeScriptCtor($component, $viewData) {
        // Instanciation du fichier de script du composant
        wp_add_inline_script($component->info->handleScriptName, 
            sprintf(
                "var instanceInfos = ComponentManager.getInfos('%s'); ComponentManager.register(instanceInfos, new %s(instanceInfos, %s));" .
                "instanceInfos = undefined;", 
                $component->info->id,
                $component->info->className, 
                json_encode($viewData)
            )
        );
    }
}