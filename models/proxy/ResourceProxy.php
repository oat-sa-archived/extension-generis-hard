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

use core_kernel_classes_Resource;
use oat\generisHard\models\hardsql\Resource;

/**
 * @access public
 * @author Joel Bout, <joel.bout@tudor.lu>
 * @package generisHard
 
 */
class ResourceProxy
    extends PersistenceProxy
        implements \core_kernel_persistence_ResourceInterface
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---
    public static $implClasses = array(
    	'hardsql' => 'oat\generisHard\models\hardsql\Resource',
        'smoothsql' => '\core_kernel_persistence_smoothsql_Resource'
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
     * returns an array of types the ressource has
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @return array
     */
    public function getTypes( core_kernel_classes_Resource $resource)
    {
        $returnValue = array();
        
        $delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getTypes($resource);

        return (array) $returnValue;
    }

    /**
     * retrieve the value of a property for the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  array options
     * @return array
     */
    public function getPropertyValues( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $options = array())
    {
        $returnValue = array();

        $delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getPropertyValues($resource, $property, $options);

		return (array) $returnValue;
    }

    /**
     * Short description of method getPropertyValuesByLg
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  string lg
     * @return \core_kernel_classes_ContainerCollection
     */
    public function getPropertyValuesByLg( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $lg)
    {
        $returnValue = null;


		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getPropertyValuesByLg($resource, $property, $lg);


        return $returnValue;
    }

    /**
     *  set the value of a property for the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  string object
     * @param  string lg
     * @return boolean
     */
    public function setPropertyValue( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $object, $lg = null)
    {
        $returnValue = (bool) false;

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setPropertyValue($resource, $property, $object);

        return (bool) $returnValue;
    }

    /**
     * set the value of an array of properties for the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  array properties
     * @return boolean
     */
    public function setPropertiesValues( core_kernel_classes_Resource $resource, $properties)
    {
        $returnValue = (bool) false;


		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setPropertiesValues($resource, $properties);


        return (bool) $returnValue;
    }

    /**
     * set the value of a property for the resource in given language
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  string value
     * @param  string lg
     * @return boolean
     */
    public function setPropertyValueByLg( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $value, $lg)
    {
        $returnValue = (bool) false;

        

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setPropertyValueByLg($resource, $property, $value, $lg);

        

        return (bool) $returnValue;
    }

    /**
     * unset the value of a property for the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  array options
     * @return boolean
     */
    public function removePropertyValues( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $options = array())
    {
        $returnValue = (bool) false;



		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->removePropertyValues($resource, $property, $options);


        return (bool) $returnValue;
    }

    /**
     * unset the value of a property for the resource in the given language
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @param  string lg
     * @param  array options
     * @return boolean
     */
    public function removePropertyValueByLg( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property, $lg, $options = array())
    {
        $returnValue = (bool) false;


		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->removePropertyValueByLg($resource, $property, $lg, $options);



        return (bool) $returnValue;
    }

    /**
     * retrieve all triples where resource is the subject
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @return \core_kernel_classes_ContainerCollection
     */
    public function getRdfTriples( core_kernel_classes_Resource $resource)
    {
        $returnValue = null;

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getRdfTriples($resource);

        return $returnValue;
    }

    /**
     * For a resource, retrieve languages used for a property
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Property property
     * @return array
     */
    public function getUsedLanguages( core_kernel_classes_Resource $resource,  \core_kernel_classes_Property $property)
    {
        $returnValue = array();

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getUsedLanguages($resource, $property);

        return (array) $returnValue;
    }

    /**
     * duplicate the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  array excludedProperties
     * @return core_kernel_classes_Resource
     */
    public function duplicate( core_kernel_classes_Resource $resource, $excludedProperties = array())
    {
        $returnValue = null;

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->duplicate($resource, $excludedProperties);

        return $returnValue;
    }

    /**
     * delete the resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  boolean deleteReference
     * @return boolean
     */
    public function delete( core_kernel_classes_Resource $resource, $deleteReference = false)
    {
        $returnValue = (bool) false;

		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->delete($resource, $deleteReference);

        return (bool) $returnValue;
    }

    /**
     * retrieve values of properties for the givens resource
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  array properties
     * @return array
     */
    public function getPropertiesValues( core_kernel_classes_Resource $resource, $properties)
    {
        $returnValue = array();

       
		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->getPropertiesValues($resource, $properties/*, $last*/);
        
        return (array) $returnValue;
    }

    /**
     * set type of the given resource 
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Class class
     * @return boolean
     */
    public function setType( core_kernel_classes_Resource $resource,  \core_kernel_classes_Class $class)
    {
        $returnValue = (bool) false;

       
		$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setType($resource, $class);
		
        return (bool) $returnValue;
    }

    /**
     *  remove type of the given resource 
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  Class class
     * @return boolean
     */
    public function removeType( core_kernel_classes_Resource $resource,  \core_kernel_classes_Class $class)
    {
		$delegate = $this->getImpToDelegateTo($resource);
		return  (bool) $delegate->removeType($resource, $class);		
    }

    /**
     * Retrieve the inplementation to delegate
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Resource resource
     * @param  array params
     * @return \core_kernel_persistence_ResourceInterface
     */
    public function getImpToDelegateTo( core_kernel_classes_Resource $resource, $params = array())
    {
        $returnValue = null;

        if(!isset(self::$ressourcesDelegatedTo[$resource->getUri()]) 
        || PersistenceProxy::isForcedMode()){
        	
			foreach($this->getImplementations() as $delegate) {
				// If the implementation is enabled && the resource exists in this context
				if($delegate->isValidContext($resource)){
					
					if(PersistenceProxy::isForcedMode()){
						return $delegate;
					}
					
					self::$ressourcesDelegatedTo[$resource->getUri()] = $delegate;
					break;
		        }
			}
        }
		if(isset(self::$ressourcesDelegatedTo[$resource->getUri()])){
			$returnValue = self::$ressourcesDelegatedTo[$resource->getUri()];
		}else{
			throw new \core_kernel_persistence_Exception("The resource with uri {$resource->getUri()} does not exist in the available implementation(s)");
		}

		\common_Logger::d(get_class($returnValue));

        return $returnValue;
    }
    
    /**
     * Remove a resource from the cache
     * 
     * @param core_kernel_classes_Resource $resource
     */
    public function uncacheResource(core_kernel_classes_Resource $resource) {
        unset(self::$ressourcesDelegatedTo[$resource->getUri()]);
    }

    protected function getImplementations()
    {
        return array(
            'hardsql' => Resource::singleton(),
            'smoothsql' => $this->getSmoothResourceInterface()
        );
    }
    
    /**
     *
     * @return \core_kernel_persistence_ClassInterface
     */
    private function getSmoothResourceInterface()
    {
        return new \core_kernel_persistence_smoothsql_Resource($this->getSmoothModel());
    }
}