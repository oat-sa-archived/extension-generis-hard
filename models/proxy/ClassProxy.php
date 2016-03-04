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
 * Copyright (c) 2009-2012 (original work) Public Research Centre Henri Tudor (under the project TAO-SUSTAIN & TAO-DEV);
 *               
 * 
 */

namespace oat\generisHard\models\proxy;

use oat\generisHard\models\hardsql\Clazz;
use oat\generis\model\data\Model;
use oat\generisHard\models\ProxyModel;

/**
 * Short description of class self
 *
 * @access public
 * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
 * @package generisHard
 
 */
class ClassProxy
    extends ResourceProxy
        implements \core_kernel_persistence_ClassInterface
{

    // --- ATTRIBUTES ---
    public static $implClasses = array(
    	'hardsql' => 'oat\generisHard\models\hardsql\Clazz',
        'smoothsql' => '\\core_kernel_persistence_smoothsql_Class'
    );

    /**
     * Short description of attribute ressourcesDelegatedTo
     *
     * @access public
     * @var array
     */
    public static $ressourcesDelegatedTo = array();

    // --- OPERATIONS ---

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::getSubClasses()
     */
    public function getSubClasses( \core_kernel_classes_Class $resource, $recursive = false)
    {
        $returnValue = array();

    	
        $delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Clazz){
                // Use the smooth sql implementation to get this information
		// Or find the right way to treat this case
                $returnValue = $this->getSmoothClassInterface()->getSubClasses($resource, $recursive);
        }else{
                $returnValue = $delegate->getSubClasses($resource, $recursive);
        }
        

        return (array) $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::isSubClassOf()
     */
    public function isSubClassOf( \core_kernel_classes_Class $resource,  \core_kernel_classes_Class $parentClass)
    {
        $returnValue = (bool) false;

        
        $delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Clazz){
                // Use the smooth sql implementation to get this information
		// Or find the right way to treat this case
                $returnValue = $this->getSmoothClassInterface()->isSubClassOf($resource, $parentClass);
        }else{
                $returnValue = $delegate->isSubClassOf($resource, $parentClass);
        }
        

        return (bool) $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::getParentClasses()
     */
    public function getParentClasses( \core_kernel_classes_Class $resource, $recursive = false)
    {
        $returnValue = array();

        
        $delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Clazz){
                // Use the smooth sql implementation to get this information
		// Or find the right way to treat this case
                $returnValue = $this->getSmoothClassInterface()->getParentClasses($resource, $recursive);
        }else{
                $returnValue = $delegate->getParentClasses($resource, $recursive);
        }
        

        return (array) $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::getProperties()
     */
    public function getProperties( \core_kernel_classes_Class $resource, $recursive = false)
    {
        $returnValue = array();

        
    	$delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Clazz){
                // Use the smooth sql implementation to get this information
		// Or find the right way to treat this case
                $returnValue = $this->getSmoothClassInterface()->getProperties($resource, $recursive);
        }else{
                $returnValue = $delegate->getProperties($resource, $recursive);
        }
        

        return (array) $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::getInstances()
     */
    public function getInstances( \core_kernel_classes_Class $resource, $recursive = false, $params = array())
    {
        $returnValue = array();

        
        $delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getInstances($resource, $recursive, $params);


        return (array) $returnValue;
    }


    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::createInstance()
     */
    public function createInstance( \core_kernel_classes_Class $resource, $label = '', $comment = '', $uri = '')
    {
        $returnValue = null;

        
        
        $delegate = $this->getImpToDelegateTo($resource);
        $returnValue = $delegate->createInstance($resource, $label, $comment, $uri);
        
        

        return $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::createSubClass()
     */    
    public function createSubClass( \core_kernel_classes_Class $resource, $label = '', $comment = '', $uri = '')
    {
        $delegate = $this->getImpToDelegateTo($resource);
        return $delegate->createSubClass($resource, $label, $comment, $uri);
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::createProperty()
     */
    public function createProperty( \core_kernel_classes_Class $resource, $label = '', $comment = '', $isLgDependent = false)
    {
        $returnValue = null;

        
    	$delegate = $this->getImpToDelegateTo($resource);
        $returnValue = $delegate->createProperty($resource, $label, $comment, $isLgDependent);
        

        return $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::searchInstances()
     */
    public function searchInstances( \core_kernel_classes_Class $resource, $propertyFilters = array(), $options = array())
    {
        $returnValue = array();

        
        
        $clazzToImpls = array();
        $implsToDelegateTo = array();
        
        if (isset($options['recursive']) && $options['recursive']) {
	        $clazzes = $this->getSubClasses($resource, true);
	        $clazzes[] = $resource; 
        }
        else {
        	$clazzes = array($resource);
        }
        unset($options['recursive']);
        
        if (isset($options['additionalClasses'])) {
	        foreach ($options['additionalClasses'] as $addclass) {
	        	$clazzes[] = ($addclass instanceof \core_kernel_classes_Resource) ? $addclass : new \core_kernel_classes_Class($addclass);
	        }
        }
        unset($options['additionalClasses']);

        foreach ($clazzes as $clazz) {
	        $delegate = $this->getImpToDelegateTo($clazz);
	        if (!isset($clazzToImpls[get_class($delegate)])) {
		        $clazzToImpls[get_class($delegate)] = array();
		        $implsToDelegateTo[get_class($delegate)] = $delegate;
	        }
	        $clazzToImpls[get_class($delegate)][] = $clazz;
        }
                
        //@todo allow dev to search with limit and offset on multiple impls
        if (count(array_keys($implsToDelegateTo)) > 1 && (isset($options['limit']) || isset($options['offset']))) {
        	throw new \common_Exception('Unable to search instances on multiple implementations with the options limit and offset');
        }

        foreach ($implsToDelegateTo as $clazzName => $delegate){
	        $classes = $clazzToImpls[$clazzName];
	        $firstClass = array_shift($classes);
	        $options['additionalClasses'] = $classes;
	                        
	        $returnValue = array_merge($returnValue, $delegate->searchInstances($firstClass, $propertyFilters, $options));
        }
        

        return (array) $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::countInstances()
     */
    public function countInstances( \core_kernel_classes_Class $resource, $propertyFilters = array(), $options = array())
    {
        $returnValue = null;

        
        
		$delegate = $this->getImpToDelegateTo($resource);
        $returnValue = $delegate->countInstances($resource, $propertyFilters, $options);
        
        

        return $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::getInstancesPropertyValues()
     */
    public function getInstancesPropertyValues( \core_kernel_classes_Class $resource,  \core_kernel_classes_Property $property, $propertyFilters = array(), $options = array())
    {
        $returnValue = array();

        
        
        $delegate = $this->getImpToDelegateTo($resource);
        $returnValue = $delegate->getInstancesPropertyValues($resource, $property, $propertyFilters, $options);
        
        

        return (array) $returnValue;
    }


    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::createInstanceWithProperties()
     */
    public function createInstanceWithProperties( \core_kernel_classes_Class $type, $properties)
    {
        $returnValue = null;

        
        $delegate = $this->getImpToDelegateTo($type);
        $returnValue = $delegate->createInstanceWithProperties($type, $properties);
        

        return $returnValue;
    }

    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::deleteInstances()
     */
    public function deleteInstances( \core_kernel_classes_Class $resource, $resources, $deleteReference = false)
    {
        $returnValue = (bool) false;

        
        $delegate = $this->getImpToDelegateTo($resource);
        $returnValue = $delegate->deleteInstances($resource, $resources, $deleteReference);
        

        return (bool) $returnValue;
    }
    
    /**
     * (non-PHPdoc)
     * @see \oat\generisHard\models\proxy\PersistenceProxy::getImpToDelegateTo()
     */
    public function getImpToDelegateTo( \core_kernel_classes_Resource $resource, $params = array())
    {
        $returnValue = null;

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
        
        $returnValue = self::$ressourcesDelegatedTo[$resource->getUri()];
        
        return $returnValue;
    }
    
    /**
     * (non-PHPdoc)
     * @see core_kernel_persistence_ClassInterface::setSubClassOf()
     */
    public function setSubClassOf( \core_kernel_classes_Class $resource,  \core_kernel_classes_Class $iClass)
    {
        $returnValue = (bool) false;
    
         
        $delegate = $this->getImpToDelegateTo($resource);
        if($delegate instanceof Clazz){
            // Use the smooth sql implementation to get this information
            // Or find the right way to treat this case
            $returnValue = $this->getSmoothClassInterface()->setSubClassOf($resource, $iClass);
        }else{
            $returnValue = $delegate->setSubClassOf($resource, $iClass);
        }
    
        return (bool) $returnValue;
    }
    
    protected function getImplementations()
    {
        $implementations = array();
        foreach ($this->getModels() as $key => $model) {
            $implementations[$key] = $model->getRdfsInterface()->getClassImplementation();
        } 
        return $implementations;
    }
    
    /**
     * 
     * @return \core_kernel_persistence_ClassInterface
     */
    private function getSmoothClassInterface()
    {
        return $this->getImplementations()[ProxyModel::OPTION_SMOOTH_MODEL];
    }
}