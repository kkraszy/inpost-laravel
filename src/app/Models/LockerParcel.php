<?php

namespace PatrykSawicki\InPost\app\Models;

class LockerParcel
{
    private string $id;
    private string $template;

    /**
     * @param string $id
     * @param string $template
     */
    public function __construct(string $template, string $id = '')
    {
        $this->id = $id;
        $this->template = $template;
    }

    /**
     * Return array data.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'template' => $this->template,
        ];
    }
}