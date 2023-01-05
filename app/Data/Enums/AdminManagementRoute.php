<?php

namespace App\Data\Enums;

enum AdminManagementRoute: string
{
    case DATA_VIEW = 'management.admins.index';
    case DATA = 'management.admins.datatable';
    case CREATE = 'management.admins.create';
    case EDIT = 'management.admins.edit';
    case UPDATE = 'management.admins.update';
    case DELETE = 'management.admins.delete';
    case STORE = 'management.admins.store';

    public function getSlugPermission():string
    {
        return str_replace('.', '-',$this->value);
    }

    public function getMiddlewarePermission():string {
        return  'can:'.$this->getSlugPermission();
    }
}
