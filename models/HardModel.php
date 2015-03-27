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
 * Copyright (c) 2002-2008 (original work) 2014 Open Assessment Technologies SA
 * 
 */

namespace oat\generisHard\models;

use oat\generisHard\models\proxy\ClassProxy;
use oat\generisHard\models\proxy\ResourceProxy;
use oat\generisHard\models\proxy\PropertyProxy;
use oat\generis\model\data\Model;
use oat\generis\model\kernel\persistence\wrapper\RdfWrapper;

class HardModel
    implements Model
{
    private $rdfsInterface;
    
    private $persistence;
    
	/**
	 * Creates a model from a configuration array provided by getConfig()
	 * 
	 * @param array $config
	 */
    public function __construct($configuration) {
        if (!isset($configuration['persistence'])) {
            throw new \common_exception_MissingParameter('persistence', __CLASS__);
        }
        $this->persistanceId = $configuration['persistence'];
        
        $persistence = \common_persistence_SqlPersistence::getPersistence($configuration['persistence']);
        $this->rdfsInterface = new RdfsInterface($persistence); 
    }
    
	/**
	 * Returns a configuration array that can be used the model, should only contain
	 * scalars as values
	 * 
	 * @return array
	 */
	public function getConfig() {
        return array(
            'persistence' => $this->persistanceId
        );
	}

	/**
	 * @return RdfInterface
	 */
	function getRdfInterface() {
	    return new RdfWrapper($this->rdfsInterface);
	}
	
	/**
	 * @return RdfsInterface
	 */
	function getRdfsInterface() {
	    return $this->rdfsInterface;
	}
    
}