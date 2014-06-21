<?php

class RedbookBaseController extends \Controller {

    protected $_Provider = null;

    protected $_ViewDir = '';

    protected $layout;

    public $data = array();

    public $response = array(
        'status'   => false,
        'level'    => 'error',
        'message'  => 'Unable to complete your request',
        'redirect' => ''
    );

    public $error = array(
        'error' => array(
            'title'   => 'Fatal error occurred',
            'content' => 'There was an error in retrieving the data on this page'
        )
    );

    public function __construct()
    {
        $this->layout = PACKAGE . 'base';
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function setErrorTitle( $title )
    {
        $this->error['error']['title'] = $title;
    }

    protected function setErrorMessage( $message )
    {
        $this->error['error']['content'] = $message;
    }
}
