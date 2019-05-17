<?
App::uses('AppModel', 'Model');

class Deal extends AppModel
{
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        ),
        'date' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A date is required'
            )
        ),
        'status_id' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A status is required'
            )
        )
    );

}