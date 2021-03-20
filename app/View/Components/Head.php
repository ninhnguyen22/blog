<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Head extends Component
{
    /**
     * @var \App\User\Layout\Head
     */
    public $head;

    /**
     * Create a new component instance.
     *
     * @param \App\User\Layout\Head $head
     * @return void
     */
    public function __construct(\App\User\Layout\Head $head)
    {
        $this->head = $head;
    }

    /**
     * Determine if the given option is the currently selected option.
     *
     * @return string
     */
    public function meta()
    {
        $meta = $this->head->getMeta();
        $html = '';
        foreach ($meta as $tag) {
            $metaHtml = [];
            foreach ($tag as $attribute => $value) {
                $metaHtml[] = "{$attribute}=\"{$value}\"";
            }
            $html .= '<meta ' . implode(' ', $metaHtml) . '>';
        }
        return $html;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.head');
    }
}
