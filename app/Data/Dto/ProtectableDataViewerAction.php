<?php

namespace App\Data\Dto;


use App\Data\Contracts\Protectable;
use App\Foundation\DataViewer\Dto\DataViewerAction;


class ProtectableDataViewerAction extends DataViewerAction implements Protectable
{

    public function getLabel(): string
    {
        return  __($this->type);
    }

    public function getSlugPermission(): string
    {
        return str_replace('.','-',$this->route);
    }
}
