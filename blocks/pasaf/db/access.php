<?php
$capabilities = array(
 
    'block/pasaf:myaddinstance' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        ),
        
        'clonepermissionsfrom' => 'moodle/my:manageblocks'
    ),
    
    'block/pasaf:addinstance' => array(
        'riskbitmask' => 0,
        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        
        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    ),
);
