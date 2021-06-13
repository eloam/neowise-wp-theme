<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class LeaveCommentComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}