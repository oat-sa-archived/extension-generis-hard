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
 * @package core
 * @subpackage kernel_persistence
 */
class PropertyProxy
    extends PersistenceProxy
        implements \core_kernel_persistence_PropertyInterface
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---
    public static $implClasses = array(
        'hardsql' => 'oat\generisHard\models\hardsql\Property',
        'smoothsql' => '\\\core_kernel_persistence_smoothsql_Property'
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

        // section 127-0-1-1-7b8668ff:12f77d22c39:-8000:000000000000144D begin
        // section 127-0-1-1-7b8668ff:12f77d22c39:-8000:000000000000144D end

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

        // section 127-0-1-1--bedeb7e:12fb15494a5:-8000:00000000000014DB begin
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
        // section 127-0-1-1--bedeb7e:12fb15494a5:-8000:00000000000014DB end

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

        // section 127-0-1-1--bedeb7e:12fb15494a5:-8000:00000000000014DD begin
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
        // section 127-0-1-1--bedeb7e:12fb15494a5:-8000:00000000000014DD end

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

        // section 127-0-1-1-7a0c731b:12fbfab7535:-8000:0000000000001539 begin
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
        
        // section 127-0-1-1-7a0c731b:12fbfab7535:-8000:0000000000001539 end

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

        // section 127-0-1-1--330ca9de:1318ac7ca9f:-8000:0000000000001641 begin
        
    	$delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->delete($resource, $deleteReference);
        
        // section 127-0-1-1--330ca9de:1318ac7ca9f:-8000:0000000000001641 end

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

        // section 10-13-1-85-36aaae10:13bad44a267:-8000:0000000000001E25 begin
        $delegate = $this->getImpToDelegateTo($resource);
		$returnValue = $delegate->setRange($resource, $class);
        // section 10-13-1-85-36aaae10:13bad44a267:-8000:0000000000001E25 end

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
        // section 10-13-1-85-71dc1cdd:13bade8452c:-8000:0000000000001E32 begin
        $delegate = $this->getImpToDelegateTo($resource);
		$delegate->setMultiple($resource, $isMultiple);
        // section 10-13-1-85-71dc1cdd:13bade8452c:-8000:0000000000001E32 end
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
        // section 10-13-1-85-4a20f448:13bdca46e9a:-8000:0000000000001E45 begin
        $delegate = $this->getImpToDelegateTo($resource);
		$delegate->setLgDependent($resource, $isLgDependent);
        // section 10-13-1-85-4a20f448:13bdca46e9a:-8000:0000000000001E45 end
    }

    /**
     * Short description of method singleton
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @return PersistenceProxy
     */
    public static function singleton()
    {
        $returnValue = null;

        // section 127-0-1-1--30506d9:12f6daaa255:-8000:0000000000001401 begin

        if(self::$instance == null){
                self::$instance = new self();
        }
        $returnValue = self::$instance;

        // section 127-0-1-1--30506d9:12f6daaa255:-8000:0000000000001401 end

        return $returnValue;
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
        $returnValue = null;

        // section 127-0-1-1--6705a05c:12f71bd9596:-8000:0000000000001F63 begin
		
        if(!isset(self::$ressourcesDelegatedTo[$resource->getUri()]) 
        || PersistenceProxy::isForcedMode()){
        	
	    	$impls = $this->getAvailableImpl($params);
                foreach($impls as $implName=>$enable){
                        // If the implementation is enabled && the resource exists in this context
                        if($enable && $this->isValidContext($implName, $resource)){
                                $implClass = self::$implClasses[$implName];
                                $reflectionMethod = new ReflectionMethod($implClass, 'singleton');
                                $delegate = $reflectionMethod->invoke(null);

                                if(PersistenceProxy::isForcedMode()){
                                        return $delegate;
                                }

                                self::$ressourcesDelegatedTo[$resource->getUri()] = $delegate;
                                break;
                        }
                }
        }

		$returnValue = self::$ressourcesDelegatedTo[$resource->getUri()];

        // section 127-0-1-1--6705a05c:12f71bd9596:-8000:0000000000001F63 end

        return $returnValue;
    }

    /**
     * Short description of method isValidContext
     *
     * @access public
     * @author Jerome Bogaerts, <jerome.bogaerts@tudor.lu>
     * @param  string context
     * @param  Resource resource
     * @return boolean
     */
    public function isValidContext($context,  \core_kernel_classes_Resource $resource)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--499759bc:12f72c12020:-8000:000000000000155E begin

        $impls = $this->getAvailableImpl(); 
        if(isset($impls[$context]) && $impls[$context]){
            
        	$implClass = self::$implClasses[$context];
        	$reflectionMethod = new ReflectionMethod($implClass, 'singleton');
                $singleton = $reflectionMethod->invoke(null);
                try{
                	$returnValue = $singleton->isValidContext($resource);
                }catch(Exception $e){
                	echo 'error*';
                }
        }
        
        // section 127-0-1-1--499759bc:12f72c12020:-8000:000000000000155E end

        return (bool) $returnValue;
    }

}