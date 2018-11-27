<?php

namespace markhuot\CraftQL\FieldBehaviors;


use markhuot\CraftQL\Behaviors\FieldBehavior;

class ContentQueryArguments extends FieldBehavior {

    function initContentQueryArguments() {
        $this->owner->addBooleanArgument('relativeUrls');

        $fieldService = \Yii::$container->get('craftQLFieldService');
        $arguments = $fieldService->getQueryArguments($this->owner->getRequest());
        $this->owner->addArguments($arguments, false);
    }

}