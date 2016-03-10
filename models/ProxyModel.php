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

class ProxyModel extends ConfigurableService implements Model
{
    const OPTION_HARD_MODEL = 'hardsql';
    
    const OPTION_SMOOTH_MODEL = 'smoothsql';
    
    private $rdfsInterface;
    
    private $smooth;
    
    private $hard;
    
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
	        $this->rdfsInterface = new RdfsInterface($this->getHardModel(), $this->getSmoothModel());
	    }
	    return $this->rdfsInterface;
	}
	
	/**
	 * @return Model
	 */
	public function getSmoothModel()
	{
	    if (is_null($this->smooth)) {
    	    $this->smooth = $this->getOption(self::OPTION_SMOOTH_MODEL);
	    }
	    return $this->smooth;
	}
	
	/**
	 * @return Model
	 */
	public function getHardModel()
	{
	    if (is_null($this->hard)) {
    	    $this->hard = $this->getOption(self::OPTION_HARD_MODEL);
    	    $this->hard->setFallback($this->getSmoothModel());
	    }
	    return $this->hard;
	}
    
}