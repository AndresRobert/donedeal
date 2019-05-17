<?
App::uses('AppModel', 'Model');

class Statu extends AppModel
{
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        )
    );

}