<?php

namespace markhuot\CraftQL\FieldBehaviors;


use markhuot\CraftQL\Behaviors\FieldBehavior;

class UrlQueryArguments extends FieldBehavior {

    function initUrlQueryArguments() {
        $this->owner->addBooleanArgument('relative');

        $fieldService = \Yii::$container->get('craftQLFieldService');
        $arguments = $fieldService->getQueryArguments($this->owner->getRequest());
        $this->owner->addArguments($arguments, false);
    }

}