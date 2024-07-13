<?php 
class Feedback {
    private $_db = null,
            $_data = null,
            $_session_name = null,
            $_is_logged_in = false,
            $_filename = 'feedback',
            $_filepath = '';
    
    /**
     * User could be an user id or email
     *
     */
    public function __construct()
    {
        $this->_filepath = "database/{$this->_filename}.json";
    }
    public function load()
    {  
        if ( file_exists( $this->_filepath ) ) {
            return json_decode( file_get_contents( $this->_filepath ), true );
        } else {
            return [];
        }
    }
        
    public function create($fields = []): void
    {  
        $stored_data = $this->load();
        array_push( $stored_data, $fields );
        file_put_contents( $this->_filepath, json_encode( $stored_data, JSON_PRETTY_PRINT ) );
    }
    
    public function data() {
        return $this->_data;
    }
}