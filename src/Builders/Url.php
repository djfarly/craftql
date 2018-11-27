<?php

namespace markhuot\CraftQL\Builders;

class Url extends Field {

    function getResolve() {
        return function ($root, $args, $context, $info) {
            $relative = false;

            if (isset($args['relative'])) {
                $relative = true;
            }

            $url = $root->{$info->fieldName};

            if ($this->isNonNull() && !$url) {
                throw new Error("`{$info->fieldName}` is a required field but has no value");
            }

            if (!$url) {
                return null;
            }

            if ($relative) {
                $url = parse_url($url, PHP_URL_PATH);
            }

            return $url;
        };
    }

}