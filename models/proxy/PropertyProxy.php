<?php
/*  
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
 * Copyright (c) 2009-2012 (original work) Public Research Centre Henri Tudor (under the project TAO-SUSTAIN & TAO-DEV);
 *               
 * 
 */

namespace oat\generisHard\models\proxy;

use oat\generisHard\models\hardsql\Property;

/**
 * @access public
 * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
 * @package generisHard
 
 */
class PropertyProxy
    extends PersistenceProxy
        implements \core_kernel_persistence_PropertyInterface
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---
    public static $implClasses = array(
        'hardsql' => 'oat\generisHard\models\hardsql\Property',
        'smoothsql' => '\core_kernel_persistence_smoothsql_Property'
    );
    
    /**
     * Short description of attribute instance
     *
     * @access public
     * @var PersistenceProxy
     */
    public static $instance = null;

    /**
     * Short description of attribute ressourcesDelegatedTo
     *
     * @access public
     * @var array
     */
    public static $ressourcesDelegatedTo = array();

    // --- OPERATIONS ---

    /**
     * Short description of method getSubProperties
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  boolean recursive
     * @return array
     */
    public function getSubProperties( \core_kernel_classes_Resource $resource, $recursive = false)
    {
        $returnValue = array();

        
        

        return (array) $returnValue;
    }

    /**
     * Short description of method isLgDependent
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @return boolean
     */
    public function isLgDependent( \core_kernel_classes_Resource $resource)
    {
        $returnValue = (bool) false;

        
        $lgDependentProperty = new \core_kernel_classes_Property(PROPERTY_IS_LG_DEPENDENT, __METHOD__);
        $lgDependent = null;

        $delegate = $this->getImpToDelegateTo($resource);
        if ($delegate instanceof Property) {
                // Use the smooth sql implementation to get this information
                // Or find the right way to treat this case
                $lgDependent = \core_kernel_persistence_smoothsql_Resource::singleton()->getOnePropertyValue($resource, $lgDependentProperty);
        } else {
                $lgDependent = $delegate->getOnePropertyValue($resource, $lgDependentProperty);
        }

        if (is_null($lgDependent)) {
                $returnValue = false;
        } else {
                $returnValue = ($lgDependent->getUri() == GENERIS_TRUE);
        }
        

        return (bool) $returnValue;
    }

    /**
     * Short description of method isMultiple
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @return boolean
     */
    public function isMultiple( \core_kernel_classes_Resource $resource)
    {
        $returnValue = (bool) false;

        
        $multipleProperty = new \core_kernel_classes_Property(PROPERTY_MULTIPLE,__METHOD__);
        $multiple = null;
        
		$delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Property){
            // Use the smooth sql implementation to get this information
			// Or find the right way to treat this case
			$multiple = \core_kernel_persistence_smoothsql_Resource::singleton()->getOnePropertyValue($resource, $multipleProperty);
        } else {
			$multiple = $delegate->getOnePropertyValue($resource, $multipleProperty);
        }
        
        if(is_null($multiple)){
			$returnValue = false;
        }
        else{
			$returnValue = ($multiple->getUri() == GENERIS_TRUE);
        }
        

        return (bool) $returnValue;
    }

    /**
     * Short description of method getRange
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @return \core_kernel_classes_Class
     */
    public function getRange( \core_kernel_classes_Resource $resource)
    {
        $returnValue = null;

        
        $rangeProperty = new \core_kernel_classes_Property(RDFS_RANGE,__METHOD__);
        $rangeValues = array();
        
        $delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Property){
        // Use the smooth sql implementation to get this information
		// Or find the right way to treat this case
                $rangeValues = \core_kernel_persistence_smoothsql_Resource::singleton()->getPropertyValues($resource, $rangeProperty);
        }else{
                $rangeValues = $delegate->getPropertyValues($resource, $rangeProperty);
        }
		        
        if(sizeOf($rangeValues)>0){
                $returnValue = new \core_kernel_classes_Class($rangeValues[0]);
        }
        
        

        return $returnValue;
    }

    /**
     * Short description of method delete
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  boolean deleteReference
     * @return boolean
     */
    public function delete( \core_kernel_classes_Resource $resource, $deleteReference = false)
    {
        $returnValue = (bool) false;

        
        
    	$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->delete($resource, $deleteReference);
        
        

        return (bool) $returnValue;
    }

    /**
     * Short description of method setRange
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  Class class
     * @return \core_kernel_classes_Class
     */
    public function setRange( \core_kernel_classes_Resource $resource,  \core_kernel_classes_Class $class)
    {
        $returnValue = null;

        
        $delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setRange($resource, $class);
        

        return $returnValue;
    }

    /**
     * Short description of method setMultiple
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  boolean isMultiple
     * @return void
     */
    public function setMultiple( \core_kernel_classes_Resource $resource, $isMultiple)
    {
        
        $delegate = $this->getImpToDelegateTo($resource);
		$delegate->setMultiple($resource, $isMultiple);
        
    }

    /**
     * Short description of method setLgDependent
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  boolean isLgDependent
     * @return void
     */
    public function setLgDependent( \core_kernel_classes_Resource $resource, $isLgDependent)
    {
        
        $delegate = $this->getImpToDelegateTo($resource);
		$delegate->setLgDependent($resource, $isLgDependent);
        
    }

    /**
     * Singleton
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @return PersistenceProxy
     */
    public static function singleton()
    {
        if(self::$instance == null){
                self::$instance = new self();
        }
        return self::$instance;

    }

    /**
     * Short description of method getImpToDelegateTo
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  Resource resource
     * @param  array params
     * @return \core_kernel_persistence_ResourceInterface
     */
    public function getImpToDelegateTo( \core_kernel_classes_Resource $resource, $params = array())
    {
        $impls = $this->getImplementations();
        if (PersistenceProxy::isForcedMode()) {
            return $impls[PersistenceProxy::getForcedMode()];
        }
        
        if(!isset(self::$ressourcesDelegatedTo[$resource->getUri()]) 
        || PersistenceProxy::isForcedMode()){
        	
			foreach($this->getImplementations() as $code => $delegate) {
				// If the implementation is enabled && the resource exists in this context
				if($delegate->isValidContext($resource)){
					
					if(PersistenceProxy::isForcedMode($code)){
						return $delegate;
					}
					
					self::$ressourcesDelegatedTo[$resource->getUri()] = $delegate;
					break;
		        }
			}
        }
        \common_Logger::d(get_class($returnValue));
        

		return self::$ressourcesDelegatedTo[$resource->getUri()];

    }

    protected function getImplementations()
    {
        $implementations = array();
        foreach ($this->getModels() as $key => $model) {
            $implementations[$key] = $model->getRdfsInterface()->getPropertyImplementation();
        }
        return $implementations;
    }
}