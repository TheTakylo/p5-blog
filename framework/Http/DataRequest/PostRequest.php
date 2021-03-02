<?php

namespace Framework\Http\DataRequest;

class PostRequest extends AbstractDataRequest
{
    public function get($item = false)
    {
        if (!$item) {
            return parent::get();
        }

        return parent::get($item);
    }

    public function data()
    {
        $output = [];

        foreach ($this->all() as $item => $v) {
            $output[$item] = $this->get($item);
        }

        return $output;
    }
}