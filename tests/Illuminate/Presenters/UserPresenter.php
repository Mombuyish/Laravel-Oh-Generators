<?php

namespace Yish\Generators\Tests\Illuminate\Presenters;

class UserPresenter
{
    public function gender($value)
    {
        switch ($value) {
            case 0 :
                return 'male';
            case 1 :
                return 'female';
            default:
                return 'trans-gender';
        }
    }
}