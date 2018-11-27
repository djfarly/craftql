<?php

namespace markhuot\CraftQL\Directives;

use GraphQL\Type\Definition\Directive;
use GraphQL\Type\Definition\DirectiveLocation;

class Normalize {

    static $directive;
    static $dateFormatTypesEnum;

    static function directive() {
        if (static::$directive) {
            return static::$directive;
        }

        return static::$directive = new Directive([
            'name' => 'normalize',
            'description' => 'Normalize contents that are specific to craft',
            'locations' => [
                DirectiveLocation::FIELD,
            ]
        ]);
    }

}
