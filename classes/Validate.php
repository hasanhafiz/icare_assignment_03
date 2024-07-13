<?php 
class Validate {
    private $_passed = false;
    private $_erros = [];
    
    // initialize db
    public function __construct()
    {
    }
    
    public function check( $source, $items = [] ) {                
        // check required field
        if ( !empty( $items ) ) {
            foreach ($items as $key => $item) {                
                if ( ! Input::get($item)  ) {
                    $this->addError("{$item} is required!");
                }
            }
        }              
        
        // check user already exists 
        if ( !empty( $source['email'] ) ) {            
            $user = new User();
            $user_email = $source['email'];
            if ( $user->exists( $user_email ) ) {
                $this->addError("{$user_email} is already exists!");
            }                                  
        }
        
        // check password mismatch
        if ( !empty( $source['password'] ) && !empty( $source['confirm_password'] ) ) {                                
            if ( $source['password'] == $source['confirm_password']) {
                $this->addError("Password does not match!");
            }                 
        }
        
        if ( empty( $this->_erros ) ) {
            $this->_passed = true;
        }
                
        return $this;        
    }
    
    public function passed() {
        return $this->_passed;
    }
    
    public function addError(string $error): void
    {
        $this->_erros[] = $error; 
    }
    
    public function errors() {
        return $this->_erros;
    }
}