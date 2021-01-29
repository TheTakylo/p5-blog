<?php

namespace Framework\Http\DataRequest;

class PostRequest extends AbstractDataRequest
{
    public function get($item = false, $secure = true)
    {
        if (!$item) {
            return parent::get();
        }

        if (!$secure) {
            return parent::get($item);
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