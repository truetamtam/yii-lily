<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LLoginFormValidator
 *
 * @author georgeee
 */
class LLoginFormValidator extends CValidator {

    //put your code here
    protected function validateAttribute($object, $attribute) {
        if (isset($object->service) && $object->service != 'email' && $object->service != '')
            return;
        $v = ($attribute == 'email' ? CValidator::createValidator('email', $object, $attribute) : CValidator::createValidator('match', $object, $attribute, array('pattern' => Yii::app()->getModule('lily')->passwordRegexp)));
        $v->validate($object);
        $v = CValidator::createValidator('required', $object, $attribute);
        $v->validate($object);
    }

    public function clientValidateAttribute($object, $attribute) {


        $v1 = ($attribute == 'email' ? CValidator::createValidator('email', $object, $attribute) : CValidator::createValidator('match', $object, $attribute, array('pattern' => Yii::app()->getModule('lily')->passwordRegexp)));
        $v2 = CValidator::createValidator('required', $object, $attribute);

        return "if ( $('#loginForm .authMethodSelect').val() == 'email' ) {".$v1->clientValidateAttribute($object, $attribute)
                .$v2->clientValidateAttribute($object, $attribute) . "}";
    }

}

?>
