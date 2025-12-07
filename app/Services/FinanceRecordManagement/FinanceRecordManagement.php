<?php

namespace App\Services\FinanceRecordManagement;

use App\Core\Log;
use App\Core\Management;
use App\Dto\Records\CreateRecord;
use App\Dto\Records\Record;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use Exception;

class FinanceRecordManagement extends Management
{
    /**
     * @throws Exception
     */
    public function createRecord(CreateRecord $createRecord) : ?Record
    {
        $recordId = $this->_createRecord($createRecord);

        if($recordId === false) {
            throw new Exception("error write record ".$createRecord->getName());
        }

        return $this->findRecordById($recordId);
    }

    public function findRecordById(int $id) : ?Record
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('records')
            ->where(['id' => $id]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            if(count($result) > 1) {
                Log::writeLog("Found record more than one in findRecordById. Check id $id");
            }

            return $this->convertArrayToRecord($result[0]);
        }

        return null;
    }

    private function _createRecord(CreateRecord $createRecord)
    {
        $insertSqlDashboard = new InsertQueryBuilder();

        $insertSqlDashboard
            ->insertInto('records')
            ->setValues($createRecord->getArray());

        $result = $insertSqlDashboard->execute($this->pdoDB);
        $recordId = $this->pdoDB->lastInsertId();
        return $recordId;
    }

    private function convertArrayToRecord(array $data) : Record
    {
        $record = new Record();
        if (isset($data['id'])) $record->setId($data['id']);
        if (isset($data['name'])) $record->setName($data['name']);
        if (isset($data['category_id'])) $record->setCategoryId($data['category_id']);
        if (isset($data['price'])) $record->setPrice($data['price']);
        if (isset($data['created_at'])) $record->setCreatedAt($data['created_at']);
        if (isset($data['by_user'])) $record->setByUser($data['by_user']);
        return $record;
    }
}