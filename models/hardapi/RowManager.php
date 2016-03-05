<?php
/*
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * Copyright (c) 2009-2012 (original work) Public Research Centre Henri Tudor (under the project TAO-SUSTAIN & TAO-DEV);
 */
namespace oat\generisHard\models\hardapi;

/**
 *
 * @access public
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package generisHard
 *         
 */
class RowManager
{

    /**
     *
     * @var \common_persistence_SqlPersistence
     */
    protected $persistence;

    /**
     * Short description of attribute table
     *
     * @access protected
     * @var string
     */
    protected $table = '';

    /**
     * Short description of attribute columns
     *
     * @access protected
     * @var array
     */
    protected $columns = array();
    
    // --- OPERATIONS ---
    
    /**
     * Short description of method __construct
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param string table
     * @param array columns
     * @return mixed
     */
    public function __construct(\common_persistence_SqlPersistence $persistence, $table, $columns)
    {
        $this->persistence = $persistence;
        $this->table = $table;
        $this->columns = $columns;
    }

    /**
     * Insert multiple rows at the same time
     *
     * @param array $rows complex array
     */
    public function insertRows($rows)
    {
        if (! empty($rows)) {
            $singleColumns = array(
                'uri' => '');
            $multiColumns = array();
            foreach ($this->columns as $column) {
                $fullProperty = Utils::getLongName($column['name']);
                if ($fullProperty !== RDF_TYPE) {
                    if (isset($column['multi']) && $column['multi'] === true) {
                        $multiColumns[$column['name']] = $column;
                    } else {
                        $singleColumns[$column['name']] = $column;
                    }
                }
            }
            $this->insertSingleValues($singleColumns, $rows);
            $this->insertMultiValues($multiColumns, $rows);
        }
    }

    protected function insertSingleValues($columns, $rows)
    {
        // single column values
        $multipleInsertQueryHelper = $this->persistence->getPlatForm()->getMultipleInsertsSqlQueryHelper();
        
        $names = array();
        foreach (array_keys($columns) as $name) {
            $names[] = $this->persistence->getPlatForm()->quoteIdentifier($name);
        }
        
        $query = $multipleInsertQueryHelper->getFirstStaticPart($this->persistence->getPlatForm()->quoteIdentifier($this->table), $names);
        foreach ($rows as $i => $row) {
            $values = array();
            foreach ($columns as $key => $column) {
                if (isset($row[$key]) && !is_null($row[$key])) {
                    $value = $row[$key];
                    $values[$key] = $this->persistence->quote(($row[$key] instanceof \core_kernel_classes_Resource) ? $row[$key]->getUri() : $row[$key]);
                } else {
                    // don't use getNullString untill function fixed
                    $values[$key] = 'null';
                }
            }
            $query .= $multipleInsertQueryHelper->getValuePart($this->table, array_keys($columns), $values);
        }
        
        $query = substr($query, 0, strlen($query) - 1);
        $query .= $multipleInsertQueryHelper->getEndStaticPart();
        $success = $this->persistence->exec($query);
    }

    protected function insertMultiValues($columns, $rows)
    {
        // get the ids of the inserted rows
        $uris = array();
        foreach ($rows as $row) {
            $uris[] = $row['uri'];
        }
        
        $instanceIds = array();
        
        $query = 'SELECT "id", "uri" FROM "' . $this->table . '" WHERE "uri" IN (\'' . implode('\',\'', $uris) . '\')';
        $result = $this->persistence->query($query);
        while ($r = $result->fetch()) {
            $instanceIds[$r['uri']] = $r['id'];
        }
        
        // If the class has multiple properties
        // Insert rows in its associate table <tableName>Props
        foreach ($rows as $row) {
            
            $queryRows = "";
            foreach ($columns as $column) {
                
                $multiplePropertyUri = Utils::getLongName($column['name']);
                	
                $multiQuery = 'SELECT "object", "l_language" FROM "statements" WHERE "subject" = ? AND "predicate" = ?';
                $multiResult = $this->persistence->query($multiQuery,array($row['uri'], $multiplePropertyUri));

                while ($t = $multiResult->fetch()){
                    if(!(empty($queryRows))){
                        $queryRows .= ',';
                    }
                    $object = $this->persistence->quote($t['object']);
        
                    if (\common_Utils::isUri($t['object'])){
                        $queryRows .= "({$instanceIds[$row['uri']]}, '{$multiplePropertyUri}', NULL, {$object}, '{$t['l_language']}')";
                    } else {
                        $queryRows .= "({$instanceIds[$row['uri']]}, '{$multiplePropertyUri}', {$object}, NULL, '{$t['l_language']}')";
        
                    }
                }
            }
        
            if (!empty($queryRows)){

                $queryMultiple = 'INSERT INTO "'.$this->table.'props"
						("instance_id", "property_uri", "property_value", "property_foreign_uri", "l_language") VALUES ' . $queryRows;
                	
                $multiplePropertiesResult = $this->persistence->exec($queryMultiple);
            }
        }
    }
}