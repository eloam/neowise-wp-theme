<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class LeaveCommentComponent extends Component
{

    private $context;

    public function init()
    {
        $this->context = Timber::context();
        $this->context['commentFormArgs'] = array(
          'class_container' => 'rounded-lg bg-gray-800 text-white p-8 my-4 shadow-lg border border-gray-200',
          'class_form' => 'grid grid-cols-2 gap-4',
          'class_submit' => 'inline-flex items-center px-4 py-2 text-base font-medium rounded-md shadow-sm text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500',
        );
    }

    public function render()
    {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}
