<?php 
class Validate {
    private $_passed = false;
    private $_erros = [];
    private $_db = null;
    
    // initialize db
    public function __construct( $filename = 'users' )
    {
        // $this->_db = new JsonFileManager( $filename );
    }
    
    public function check( $source, $items = [] ) {
    }
    
    public function passed() {
        return true;
        // return $this->_passed;
    }
    
    public function addError(string $error): void
    {
        $this->_erros[] = $error; 
    }
    
    public function errors() {
        return $this->_erros;
    }
}