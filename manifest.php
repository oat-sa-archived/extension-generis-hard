<?php
/**  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA;
 *               
 * 
 */               

return array(
    'id' => 'generisHard',
	'name' => 'Generis optimization',
	'description' => 'A perfromance oriented implementation of the ontology',
    'license' => 'GPL-2.0',
    'version' => '1.0',
	'author' => 'Open Assessment Technologies SA',
	'requires' => array('generis' => '>=2.4','tao' => '>=2.4'),
	// for compatibility
	'dependencies' => array('generis','tao'),
	'managementRole' => 'http://www.tao.lu/Ontologies/generis.rdf#generisHardManager',
    'acl' => array(
        array('grant', 'http://www.tao.lu/Ontologies/generis.rdf#generisHardManager', array('ext'=>'generisHard')),
    ),
    'autoload' => array (
        'psr-4' => array(
            'oat\\generisHard\\' => dirname(__FILE__).DIRECTORY_SEPARATOR
        )
    ),
    'routes' => array(
        '/generisHard' => 'oat\\generisHard\\actions'
    ),    
	'constants' => array(
        'DIR_VIEWS' => dirname(__FILE__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR,
        
        'BASE_WWW' => ROOT_URL.'generisHard/views/'
	)
);