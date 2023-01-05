<?php

namespace App\Data\Values;

enum AdminStatus: string
{
    case ACTIVE = 'active';
    case DISABLED = 'disable';
    case SUSPENDE = 'suspendida';

    public function title():string
    {
        return match ($this->name) {
            AdminStatus::ACTIVE->name => 'Activo'  ,
            AdminStatus::DISABLED->name => 'Deshabilitado',
            AdminStatus::SUSPENDE->name => 'Suspendido'
        };
    }

    public static function createByValue(string $value): ?self {
        return  match ($value){
            AdminStatus::ACTIVE->value => AdminStatus::ACTIVE,
            AdminStatus::DISABLED->value => AdminStatus::DISABLED,
            AdminStatus::SUSPENDE->value => AdminStatus::SUSPENDE
        };
    }

 }
