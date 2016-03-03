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
use oat\generisHard\models\proxy\RdfsInterface;

class HardModel extends ConfigurableService implements Model
{
    const OPTION_PERSISTENCE = 'persistence';
    
    const OPTION_SMOOTH_MODEL = 'smooth';
    
    private $rdfsInterface;
    
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
	    if (!isset($this->rdfsInterface)) {
	        if (!$this->hasOption(self::OPTION_PERSISTENCE)) {
	            throw new \common_exception_MissingParameter(self::OPTION_PERSISTENCE, __CLASS__);
	        }
	        
	        $persistence = \common_persistence_SqlPersistence::getPersistence($this->getOption(self::OPTION_PERSISTENCE));
	        $this->rdfsInterface = new RdfsInterface($persistence, $this->getOption(self::OPTION_SMOOTH_MODEL));
	    }
	    return $this->rdfsInterface;
	}
    
}