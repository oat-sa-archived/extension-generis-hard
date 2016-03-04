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

use oat\generis\model\data\Model;
use oat\generis\model\kernel\persistence\wrapper\RdfWrapper;
use oat\oatbox\service\ConfigurableService;
use \oat\generis\model\data\RdfsInterface;
use oat\generisHard\models\hardsql\Clazz;
use oat\generisHard\models\hardsql\Resource;
use oat\generisHard\models\hardsql\Property;

class HardModel extends ConfigurableService implements Model, RdfsInterface
{
    const OPTION_PERSISTENCE = 'persistence';
    
    private $classImpl;
    
    private $persistence;
    
	/**
	 * @return RdfInterface
	 */
	function getRdfInterface() {
	    return new RdfWrapper($this->getRdfsInterface());
	}
	
	/**
	 * @return RdfsInterface
	 */
	function getRdfsInterface() {
	    return $this;
	}
	
	private function getPersistence() {
	    
	    if (is_null($this->persistence)) {
    	    if (!$this->hasOption(self::OPTION_PERSISTENCE)) {
    	        throw new \common_exception_MissingParameter(self::OPTION_PERSISTENCE, __CLASS__);
    	    }
    	     
    	    $this->persistence = \common_persistence_SqlPersistence::getPersistence($this->getOption(self::OPTION_PERSISTENCE));
	    }
        return $this->persistence;
	}
	
	public function getClassImplementation() {
	    if (is_null($this->classImpl)) {
	        $this->classImpl = new Clazz($this->getPersistence()); 
	    }
	    return $this->classImpl;
	}
	
	public function getResourceImplementation() {
	    return new Resource($this->getPersistence());
	}
	
	public function getPropertyImplementation() {
	    return new Property($this->getPersistence());
	}
	
	public function setFallback(Model $model)
	{
	    $this->getClassImplementation()->setFallback($model->getRdfsInterface()->getClassImplementation());
	}
    
}