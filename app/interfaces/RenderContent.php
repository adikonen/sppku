<?php

interface RenderContent
{
    /**
     * render view with static template
     */
    public function render(string $view, array $data);
}