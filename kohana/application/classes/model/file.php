<?php
class Model_File extends basemodel {

    protected $_relations = array(
        'user'              => array('type' => 'belongs_to'),
        'item'              => array('type' => 'belongs_to'),
        'story'              => array('type' => 'belongs_to'),

    );
    protected $_fields = array(
        'title'             => array('type' => 'string'),
        'description'       => array('type' => 'string'),
        'created'           => array('type' => 'int'),
        'updated'           => array('type' => 'int'),
        'file_size'         => array('type' => 'int'),
        'file_mime'         => array('type' => 'int'),
        'file_md5sum'       => array('type' => 'int'),
    );

    protected $_db = "news_files";

}
?>
