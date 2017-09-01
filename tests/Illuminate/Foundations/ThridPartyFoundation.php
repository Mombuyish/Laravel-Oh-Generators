<?php

namespace Yish\Generators\Tests\Illuminate\Foundations;

class ThridPartyFoundation
{
    public function doPluginAction($value)
    {
        switch ($value) {
            case 0 :
                return 'Action 0';
            case 1 :
                return 'Action 1';
            default:
                return 'No Effect';
        }
    }
}
