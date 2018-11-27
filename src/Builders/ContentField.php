<?php

namespace markhuot\CraftQL\Builders;

use craft\base\Field as CraftField;
use GraphQL\Type\Definition\Type;
use markhuot\CraftQL\Request;

const HREF_URL_REGEX = '~(?start<a(.*?)href=")(?url[^"]+)(?end"(.*?)>)~';

class ContentField extends Field {

    protected $field;

    function __construct(Request $request, CraftField $field) {
        parent::__construct($request, $field->handle);
        $this->field = $field;
    }

    function getDescription() {
        return $this->description ?: $this->field->instructions;
    }

    function getResolve() {
        return function ($root, $args, $context, $info) {
            $relativeUrls = false;

            if (isset($args['relativeUrls'])) {
                $relativeUrls = true;
            }

            $content = $root->{$info->fieldName};

            if ($this->isNonNull() && !$content) {
                throw new Error("`{$info->fieldName}` is a required field but has no value");
            }

            if (!$content) {
                return null;
            }

            if ($relativeUrls) {
                $content = preg_replace_callback(HREF_URL_REGEX, function ($match) {
                    $match['start'] . parse_url($match['url'], PHP_URL_PATH) . $match['end'];
                }, $content);
            }

            return $content;
        };
    }

}